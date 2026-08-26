<?php
declare(strict_types=1);

session_start();

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

try {
    $db = new PDO('sqlite:' . __DIR__ . '/users.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $db->exec(
        'CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE COLLATE NOCASE,
            password_hash TEXT NOT NULL,
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
        )'
    );
} catch (PDOException $exception) {
    http_response_code(500);
    exit('Database error. Make sure PDO SQLite is enabled in PHP.');
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$message = '';
$messageType = '';
$activeForm = ($_GET['form'] ?? 'login') === 'register' ? 'register' : 'login';

if (isset($_GET['logged_out'])) {
    $message = 'You have been logged out.';
    $messageType = 'success';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedToken = (string) ($_POST['csrf_token'] ?? '');

    if (!hash_equals($_SESSION['csrf_token'], $submittedToken)) {
        $message = 'Invalid request. Refresh the page and try again.';
        $messageType = 'error';
    } else {
        $action = (string) ($_POST['action'] ?? '');

        if ($action === 'register') {
            $activeForm = 'register';

            $name = trim((string) ($_POST['name'] ?? ''));
            $email = strtolower(trim((string) ($_POST['email'] ?? '')));
            $password = (string) ($_POST['password'] ?? '');
            $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

            if ($name === '' || $email === '' || $password === '') {
                $message = 'Complete all required fields.';
                $messageType = 'error';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = 'Enter a valid email address.';
                $messageType = 'error';
            } elseif (mb_strlen($password) < 8) {
                $message = 'Password must contain at least 8 characters.';
                $messageType = 'error';
            } elseif ($password !== $confirmPassword) {
                $message = 'The passwords do not match.';
                $messageType = 'error';
            } else {
                $checkUser = $db->prepare(
                    'SELECT id FROM users WHERE email = :email LIMIT 1'
                );
                $checkUser->execute(['email' => $email]);

                if ($checkUser->fetch()) {
                    $message = 'An account with that email already exists.';
                    $messageType = 'error';
                } else {
                    $createUser = $db->prepare(
                        'INSERT INTO users (name, email, password_hash)
                         VALUES (:name, :email, :password_hash)'
                    );

                    $createUser->execute([
                        'name' => $name,
                        'email' => $email,
                        'password_hash' => password_hash(
                            $password,
                            PASSWORD_DEFAULT
                        ),
                    ]);

                    session_regenerate_id(true);

                    $_SESSION['user'] = [
                        'id' => (int) $db->lastInsertId(),
                        'name' => $name,
                        'email' => $email,
                    ];

                    header('Location: auth.php');
                    exit;
                }
            }
        }

        if ($action === 'login') {
            $activeForm = 'login';

            $email = strtolower(trim((string) ($_POST['email'] ?? '')));
            $password = (string) ($_POST['password'] ?? '');

            $findUser = $db->prepare(
                'SELECT id, name, email, password_hash
                 FROM users
                 WHERE email = :email
                 LIMIT 1'
            );
            $findUser->execute(['email' => $email]);
            $user = $findUser->fetch();

            if (!$user || !password_verify($password, $user['password_hash'])) {
                $message = 'Incorrect email or password.';
                $messageType = 'error';
            } else {
                session_regenerate_id(true);

                $_SESSION['user'] = [
                    'id' => (int) $user['id'],
                    'name' => (string) $user['name'],
                    'email' => (string) $user['email'],
                ];

                header('Location: auth.php');
                exit;
            }
        }

        if ($action === 'logout') {
            unset($_SESSION['user']);
            session_regenerate_id(true);

            header('Location: auth.php?logged_out=1');
            exit;
        }
    }
}

$currentUser = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Glenn Studio</title>

    <style>
        :root {
            --background: #070914;
            --card: rgba(255, 255, 255, 0.07);
            --border: rgba(255, 255, 255, 0.12);
            --text: #f7f7ff;
            --muted: #a9adc1;
            --purple: #8b5cf6;
            --blue: #38bdf8;
            --green: #4ade80;
            --red: #fb7185;
            --gradient: linear-gradient(135deg, var(--purple), var(--blue));
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 30px 20px;
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 20% 20%, rgba(139, 92, 246, 0.25), transparent 30%),
                radial-gradient(circle at 80% 80%, rgba(56, 189, 248, 0.18), transparent 30%),
                var(--background);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .auth-page {
            width: min(100%, 460px);
        }

        .back-link {
            display: inline-block;
            margin-bottom: 18px;
            color: var(--muted);
            font-size: 14px;
        }

        .back-link:hover {
            color: var(--text);
        }

        .auth-card {
            padding: 34px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(20px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
            font-size: 20px;
            font-weight: 800;
        }

        .brand-logo {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: var(--gradient);
        }

        .brand-highlight {
            color: #b794f6;
        }

        h1 {
            margin-bottom: 9px;
            font-size: 31px;
            line-height: 1.1;
        }

        .subtitle {
            margin-bottom: 25px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 24px;
            padding: 5px;
            background: rgba(0, 0, 0, 0.25);
            border-radius: 13px;
        }

        .tabs a {
            padding: 10px;
            border-radius: 10px;
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
            text-align: center;
        }

        .tabs a.active {
            color: white;
            background: var(--gradient);
        }

        .message {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 11px;
            font-size: 13px;
        }

        .message.error {
            color: #fecdd3;
            background: rgba(251, 113, 133, 0.12);
            border: 1px solid rgba(251, 113, 133, 0.3);
        }

        .message.success {
            color: #bbf7d0;
            background: rgba(74, 222, 128, 0.12);
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .field {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #d7d9e2;
            font-size: 12px;
            font-weight: 700;
        }

        input {
            width: 100%;
            min-height: 50px;
            padding: 0 15px;
            color: white;
            background: rgba(5, 7, 15, 0.7);
            border: 1px solid var(--border);
            border-radius: 12px;
            outline: none;
        }

        input:focus {
            border-color: var(--purple);
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.13);
        }

        input::placeholder {
            color: #666b80;
        }

        .submit-button,
        .logout-button {
            width: 100%;
            min-height: 52px;
            margin-top: 5px;
            color: white;
            background: var(--gradient);
            border: 0;
            border-radius: 13px;
            font: inherit;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
        }

        .submit-button:hover,
        .logout-button:hover {
            filter: brightness(1.08);
        }

        .helper {
            margin-top: 18px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
            text-align: center;
        }

        .profile {
            padding: 22px;
            background: rgba(139, 92, 246, 0.1);
            border: 1px solid rgba(183, 148, 246, 0.25);
            border-radius: 16px;
        }

        .profile span {
            color: var(--muted);
            font-size: 12px;
        }

        .profile strong {
            display: block;
            margin: 4px 0 18px;
            font-size: 18px;
        }

        @media (max-width: 520px) {
            .auth-card {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <main class="auth-page">
        <a class="back-link" href="index.php">← Back to home</a>

        <section class="auth-card">
            <div class="brand">
                <span class="brand-logo">G</span>
                <span>Glenn<span class="brand-highlight">Studio</span></span>
            </div>

            <?php if ($currentUser): ?>
                <h1>Welcome, <?= e((string) $currentUser['name']) ?>.</h1>
                <p class="subtitle">Your PHP login session is currently active.</p>

                <div class="profile">
                    <span>Signed in as</span>
                    <strong><?= e((string) $currentUser['email']) ?></strong>

                    <form method="post" action="auth.php">
                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= e($_SESSION['csrf_token']) ?>"
                        >
                        <input type="hidden" name="action" value="logout">
                        <button class="logout-button" type="submit">Log Out</button>
                    </form>
                </div>
            <?php else: ?>
                <h1><?= $activeForm === 'register' ? 'Create account' : 'Welcome back' ?></h1>
                <p class="subtitle">
                    <?= $activeForm === 'register'
                        ? 'Register a local account to test PHP and SQLite.'
                        : 'Sign in using an account created on this local website.' ?>
                </p>

                <nav class="tabs" aria-label="Authentication forms">
                    <a
                        class="<?= $activeForm === 'login' ? 'active' : '' ?>"
                        href="auth.php?form=login"
                    >Login</a>
                    <a
                        class="<?= $activeForm === 'register' ? 'active' : '' ?>"
                        href="auth.php?form=register"
                    >Register</a>
                </nav>

                <?php if ($message !== ''): ?>
                    <div class="message <?= e($messageType) ?>">
                        <?= e($message) ?>
                    </div>
                <?php endif; ?>

                <?php if ($activeForm === 'register'): ?>
                    <form method="post" action="auth.php?form=register">
                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= e($_SESSION['csrf_token']) ?>"
                        >
                        <input type="hidden" name="action" value="register">

                        <div class="field">
                            <label for="register-name">Full name</label>
                            <input
                                id="register-name"
                                name="name"
                                type="text"
                                placeholder="Glenn Masculino"
                                autocomplete="name"
                                required
                            >
                        </div>

                        <div class="field">
                            <label for="register-email">Email</label>
                            <input
                                id="register-email"
                                name="email"
                                type="email"
                                placeholder="you@example.com"
                                autocomplete="email"
                                required
                            >
                        </div>

                        <div class="field">
                            <label for="register-password">Password</label>
                            <input
                                id="register-password"
                                name="password"
                                type="password"
                                placeholder="At least 8 characters"
                                autocomplete="new-password"
                                minlength="8"
                                required
                            >
                        </div>

                        <div class="field">
                            <label for="confirm-password">Confirm password</label>
                            <input
                                id="confirm-password"
                                name="confirm_password"
                                type="password"
                                placeholder="Repeat your password"
                                autocomplete="new-password"
                                minlength="8"
                                required
                            >
                        </div>

                        <button class="submit-button" type="submit">
                            Create Account
                        </button>
                    </form>
                <?php else: ?>
                    <form method="post" action="auth.php?form=login">
                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= e($_SESSION['csrf_token']) ?>"
                        >
                        <input type="hidden" name="action" value="login">

                        <div class="field">
                            <label for="login-email">Email</label>
                            <input
                                id="login-email"
                                name="email"
                                type="email"
                                placeholder="you@example.com"
                                autocomplete="email"
                                required
                            >
                        </div>

                        <div class="field">
                            <label for="login-password">Password</label>
                            <input
                                id="login-password"
                                name="password"
                                type="password"
                                placeholder="Your password"
                                autocomplete="current-password"
                                required
                            >
                        </div>

                        <button class="submit-button" type="submit">
                            Log In
                        </button>
                    </form>
                <?php endif; ?>

                <p class="helper">
                    Local practice only. Account data is stored in users.sqlite.
                </p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
