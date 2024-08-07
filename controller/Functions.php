<?php

function handle_error($errno, $errstr, $errfile, $errline)
{
  // Create error log file path based on the file where the error occurred
  $errorLog = dirname(__FILE__) . '/error_log.log'; // Error log file location within the project folder

  // Format error message with additional information
  $error_message = "[" . date("Y-m-d H:i:s") . "] Error [$errno]: $errstr in $errfile on line $errline" . PHP_EOL;

  // Attempt to open the error log file in append mode, creating it if it doesn't exist
  $file_handle = fopen($errorLog, 'a');
  if ($file_handle !== false) {
    // Write error message to the log file
    fwrite($file_handle, $error_message);
    // Close the file handle
    fclose($file_handle);
  }

  // Save error message in session
  $_SESSION['error_message'] = $error_message;

  // Redirect user back to the same page only if there is no error
  if (!isset($_SESSION['error_flag'])) {
    // Set error flag to prevent infinite redirection loop
    $_SESSION['error_flag'] = true;
    // Redirect user back to the same page
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit(); // Stop further execution
  }
}

function valid($conn, $value)
{
  $valid = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $value))));
  return $valid;
}

function separateAlphaNumeric($string)
{
  $alpha = "";
  $numeric = "";
  // Mengiterasi setiap karakter dalam string
  for ($i = 0; $i < strlen($string); $i++) {
    // Memeriksa apakah karakter adalah huruf
    if (ctype_alpha($string[$i])) {
      $alpha .= $string[$i];
    }
    // Memeriksa apakah karakter adalah angka
    if (ctype_digit($string[$i])) {
      $numeric .= $string[$i];
    }
  }
  // Mengembalikan array yang berisi huruf dan angka terpisah
  return array(
    "alpha" => $alpha,
    "numeric" => $numeric
  );
}

function generateToken()
{
  // Generate a random 6-digit number
  $token = mt_rand(100000, 999999);
  return $token;
}

function compressImage($source, $destination, $quality)
{
  // mendapatkan info image
  $imgInfo = getimagesize($source);
  $mime = $imgInfo['mime'];
  // membuat image baru
  switch ($mime) {
      // proses kode memilih tipe tipe image 
    case 'image/jpeg':
      $image = imagecreatefromjpeg($source);
      break;
    case 'image/png':
      $image = imagecreatefrompng($source);
      break;
    default:
      $image = imagecreatefromjpeg($source);
  }

  // Menyimpan image dengan ukuran yang baru
  imagejpeg($image, $destination, $quality);

  // Return image
  return $destination;
}

if (!isset($_SESSION["project_plbn_motamasin"]["users"])) {
  function register($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) > 0) {
        $message = "Maaf, email yang anda masukan sudah terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        if ($data['password'] !== $data['re_password']) {
          $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        } else {
          $password = password_hash($data['password'], PASSWORD_DEFAULT);
          $token = generateToken();
          $en_user = password_hash($token, PASSWORD_DEFAULT);
          $en_user = str_replace("$", "", $en_user);
          $en_user = str_replace("/", "", $en_user);
          $en_user = str_replace(".", "", $en_user);
          $to       = $data['email'];
          $subject  = "Account Verification - PLBN Motamasin";
          $message  = "<!doctype html>
          <html>
            <head>
                <meta name='viewport' content='width=device-width'>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <title>Account Verification</title>
                <style>
                    @media only screen and (max-width: 620px) {
                        table[class='body'] h1 {
                            font-size: 28px !important;
                            margin-bottom: 10px !important;}
                        table[class='body'] p,
                        table[class='body'] ul,
                        table[class='body'] ol,
                        table[class='body'] td,
                        table[class='body'] span,
                        table[class='body'] a {
                            font-size: 16px !important;}
                        table[class='body'] .wrapper,
                        table[class='body'] .article {
                            padding: 10px !important;}
                        table[class='body'] .content {
                            padding: 0 !important;}
                        table[class='body'] .container {
                            padding: 0 !important;
                            width: 100% !important;}
                        table[class='body'] .main {
                            border-left-width: 0 !important;
                            border-radius: 0 !important;
                            border-right-width: 0 !important;}
                        table[class='body'] .btn table {
                            width: 100% !important;}
                        table[class='body'] .btn a {
                            width: 100% !important;}
                        table[class='body'] .img-responsive {
                            height: auto !important;
                            max-width: 100% !important;
                            width: auto !important;}}
                    @media all {
                        .ExternalClass {
                            width: 100%;}
                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                            line-height: 100%;}
                        .apple-link a {
                            color: inherit !important;
                            font-family: inherit !important;
                            font-size: inherit !important;
                            font-weight: inherit !important;
                            line-height: inherit !important;
                            text-decoration: none !important;
                        .btn-primary table td:hover {
                            background-color: #d5075d !important;}
                        .btn-primary a:hover {
                            background-color: #000 !important;
                            border-color: #000 !important;
                            color: #fff !important;}}
                </style>
            </head>
            <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
                <tr>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                    <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                    <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
            
                        <!-- START CENTERED WHITE CONTAINER -->
                        <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
            
                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                                <tr>
                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $data['name'] . ",</p>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                    <tbody>
                                        <tr>
                                        <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                            <tbody>
                                                <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di PLBN Motamasin.</p>
                                    <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                                </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
            
                        <!-- END MAIN CONTENT AREA -->
                        </table>
                        
                        <!-- START FOOTER -->
                        <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                        <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                            <tr>
                            <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                            </td>
                            </tr>
                            <tr>
                            <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                            </td>
                            </tr>
                        </table>
                        </div>
                        <!-- END FOOTER -->
            
                    <!-- END CENTERED WHITE CONTAINER -->
                    </div>
                    </td>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                </tr>
                </table>
            </body>
          </html>";
          smtp_mail($to, $subject, $message, "", "", 0, 0, true);
          $_SESSION['data_auth'] = ['en_user' => $en_user];
          $sql = "INSERT INTO users(en_user,token,name,email,password) VALUES('$en_user','$token','$data[name]','$data[email]','$password')";
        }
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function re_verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $name = $row['name'];
        $email = $row['email'];
        $token = generateToken();
        $reen_user = password_hash($token, PASSWORD_DEFAULT);
        $reen_user = str_replace("$", "", $reen_user);
        $reen_user = str_replace("/", "", $reen_user);
        $reen_user = str_replace(".", "", $reen_user);
        $to       = $email;
        $subject  = "Account Verification - PLBN Motamasin";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Account Verification</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di PLBN Motamasin.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $_SESSION['data_auth'] = ['en_user' => $reen_user];
        $sql = "UPDATE users SET en_user='$reen_user', token='$token', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "warning";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $token_primary = $row['token'];
        $updated_at = strtotime($row['updated_at']);
        $current_time = time();
        if (($current_time - $updated_at) > (5 * 60)) {
          $message = "Maaf, waktu untuk verifikasi telah habis.";
          $message_type = "warning";
          alert($message, $message_type);
          $_SESSION["project_plbn_motamasin"] = [
            "message-warning" => "Maaf, waktu untuk verifikasi telah habis.",
            "time-message" => time()
          ];
          return false;
        }
        if ($data['token'] !== $token_primary) {
          $message = "Maaf, kode token yang anda masukan masih salah.";
          $message_type = "warning";
          alert($message, $message_type);
          return false;
        }
        $sql = "UPDATE users SET id_active='1', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function forgot_password($conn, $data, $action, $baseURL)
  {
    if ($action == "update") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) === 0) {
        $message = "Maaf, email yang anda masukan belum terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $row = mysqli_fetch_assoc($checkEmail);
        $name = valid($conn, $row['name']);
        $token = generateToken();
        $en_user = password_hash($token, PASSWORD_DEFAULT);
        $en_user = str_replace("$", "", $en_user);
        $en_user = str_replace("/", "", $en_user);
        $en_user = str_replace(".", "", $en_user);
        $to       = $data['email'];
        $subject  = "Reset password - PLBN Motamasin";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Reset password</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Pesan ini secara otomatis dikirimkan kepada anda karena anda meminta untuk mereset kata sandi. Jika anda tidak sama sekali ingin mereset atau bukan anda yang ingin mereset abaikan saja. Klik tombol reset berikut untuk melanjutkan:</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center;' valign='top' bgcolor='#ffffff' align='center'>
                                                  <a href='" . $baseURL . "auth/new-password?en=" . $en_user . "' target='_blank' style='background-color: #ffffff; border: solid 1px #000; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; border-color: #000; color: #000;'>Atur Ulang Kata Sandi</a> 
                                                </td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $sql = "UPDATE users SET en_user='$en_user', token='$token', updated_at=current_timestamp WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function new_password($conn, $data, $action)
  {
    if ($action == "update") {
      $lenght = strlen($data['password']);
      if ($lenght < 8) {
        $message = "Maaf, password yang anda masukan harus 8 digit atau lebih.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if ($data['password'] !== $data['re_password']) {
        $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password='$password' WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function login($conn, $data)
  {
    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users JOIN user_role ON users.id_role=user_role.id_role WHERE users.email='$data[email]'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $message = "Maaf, akun yang anda masukan belum terdaftar.";
      $message_type = "danger";
      alert($message, $message_type);
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($data['password'], $row["password"])) {
        $_SESSION["project_plbn_motamasin"]["users"] = [
          "id" => $row["id_user"],
          "id_role" => $row["id_role"],
          "role" => $row["role"],
          "email" => $row["email"],
          "name" => $row["name"],
          "image" => $row["image"]
        ];
        return mysqli_affected_rows($conn);
      } else {
        $message = "Maaf, kata sandi yang anda masukan salah.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
    }
  }
}

if (isset($_SESSION["project_plbn_motamasin"]["users"])) {

  function profil($conn, $data, $action, $id_user)
  {
    if ($action == "update") {
      $path = "../assets/img/profil/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/profil/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        if ($remove_image != "default.svg") {
          unlink($path . $remove_image);
        }
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      if (!empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name='$data[name]', image='$image', password='$password' WHERE id_user='$id_user'";
      } else {
        $sql = "UPDATE users SET name='$data[name]', image='$image' WHERE id_user='$id_user'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function setting($conn, $data, $action)
  {

    if ($action == "update") {
      $path = "../assets/img/auth/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/auth/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        unlink($path . $remove_image);
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      $sql = "UPDATE auth SET image='$image', bg='$data[bg]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function users($conn, $data, $action)
  {

    if ($action == "update") {
      $sql = "UPDATE users SET id_role='$data[id_role]', id_active='$data[id_active]' WHERE id_user='$data[id_user]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function role($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
      $checkRole = mysqli_query($conn, $checkRole);
      if (mysqli_num_rows($checkRole) > 0) {
        $message = "Maaf, role yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $sql = "INSERT INTO user_role(role) VALUES('$data[role]')";
      }
    }

    if ($action == "update") {
      if ($data['role'] !== $data['roleOld']) {
        $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
        $checkRole = mysqli_query($conn, $checkRole);
        if (mysqli_num_rows($checkRole) > 0) {
          $message = "Maaf, role yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_role SET role='$data[role]' WHERE id_role='$data[id_role]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_role WHERE id_role='$data[id_role]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
      $checkMenu = mysqli_query($conn, $checkMenu);
      if (mysqli_num_rows($checkMenu) > 0) {
        $message = "Maaf, menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $sql = "INSERT INTO user_menu(menu) VALUES('$data[menu]')";
      }
    }

    if ($action == "update") {
      if ($data['menu'] !== $data['menuOld']) {
        $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
        $checkMenu = mysqli_query($conn, $checkMenu);
        if (mysqli_num_rows($checkMenu) > 0) {
          $message = "Maaf, menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_menu SET menu='$data[menu]' WHERE id_menu='$data[id_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_menu WHERE id_menu='$data[id_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu($conn, $data, $action, $baseURL)
  {
    $url = strtolower($data['title']);
    $url = str_replace(" ", "-", $url);

    if ($action == "insert") {
      $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
      $checkSubMenu = mysqli_query($conn, $checkSubMenu);
      if (mysqli_num_rows($checkSubMenu) > 0) {
        $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $file_views = fopen("../views/" . $url . ".php", "w");
        fwrite($file_views, '<?php require_once("../controller/' . $url . '.php");
        $_SESSION["project_plbn_motamasin"]["name_page"] = "' . $data['title'] . '";
        require_once("../templates/views_top.php"); ?>
        
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_plbn_motamasin"]["name_page"] ?></h1>
          </div>
        
          <!-- Mulai buatlah lembar kerja anda disini! -->
        
        </div>
        <!-- /.container-fluid -->
        
        <?php require_once("../templates/views_bottom.php") ?>
        ');
        fclose($file_views);
        $file_controller = fopen("../controller/" . $url . ".php", "w");
        fwrite($file_controller, '<?php

        require_once("../config/Base.php");
        require_once("../config/Auth.php");
        require_once("../config/Alert.php");
        ');
        fclose($file_controller);
        $sql = "INSERT INTO user_sub_menu(id_menu,id_active,title,url,icon) VALUES('$data[id_menu]','$data[id_active]','$data[title]','$url','$data[icon]')";
      }
    }

    if ($action == "update") {
      if ($data['title'] !== $data['titleOld']) {
        $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
        $checkSubMenu = mysqli_query($conn, $checkSubMenu);
        if (mysqli_num_rows($checkSubMenu) > 0) {
          $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_sub_menu SET id_menu='$data[id_menu]', id_active='$data[id_active]', title='$data[title]', url='$url', icon='$data[icon]' WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    if ($action == "delete") {
      unlink("../views/" . $url . ".php");
      unlink("../controller/" . $url . ".php");
      $sql = "DELETE FROM user_sub_menu WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_menu(id_role,id_menu) VALUES('$data[id_role]','$data[id_menu]')";
    }

    if ($action == "update") {
      $sql = "UPDATE user_access_menu SET id_role='$data[id_role]', id_menu='$data[id_menu]' WHERE id_access_menu='$data[id_access_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_menu WHERE id_access_menu='$data[id_access_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_sub_menu(id_role,id_sub_menu) VALUES('$data[id_role]','$data[id_sub_menu]')";
    }

    if ($action == "update") {
      $sql = "UPDATE user_access_sub_menu SET id_role='$data[id_role]', id_sub_menu='$data[id_sub_menu]' WHERE id_access_sub_menu='$data[id_access_sub_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_sub_menu WHERE id_access_sub_menu='$data[id_access_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kategori($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO kategori(nama_kategori) VALUES('$data[nama_kategori]')";
    }

    if ($action == "update") {
      $sql = "UPDATE kategori SET nama_kategori='$data[nama_kategori]' WHERE id_kategori='$data[id_kategori]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM kategori WHERE id_kategori='$data[id_kategori]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function data_barang($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO data_barang(nama_barang,detail_barang) VALUES('$data[nama_barang]','$data[detail_barang]')";
    }

    if ($action == "update") {
      $sql = "UPDATE data_barang SET nama_barang='$data[nama_barang]', detail_barang='$data[detail_barang]' WHERE id_barang='$data[id_barang]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM data_barang WHERE id_barang='$data[id_barang]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function export_import($conn, $data, $action)
  {
    if ($action == "update") {
      $sql = "UPDATE export_import SET id_barang='$data[id_barang]', kapasitas='$data[kapasitas]', tgl_pengiriman='$data[tgl_pengiriman]', daerah_asal='$data[daerah_asal]', daerah_tujuan='$data[daerah_tujuan]' WHERE id_export_import='$data[id_export_import]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM export_import WHERE id_export_import='$data[id_export_import]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function exportDIToPDF($conn)
  {
    $query = "SELECT data_izin.*, kategori.nama_kategori, data_barang.nama_barang, export_import.kapasitas, export_import.tgl_pengiriman, export_import.daerah_asal, export_import.daerah_tujuan
    FROM data_izin 
    JOIN export_import ON data_izin.id_export_import = export_import.id_export_import 
    JOIN kategori ON export_import.id_kategori = kategori.id_kategori 
    JOIN data_barang ON export_import.id_barang = data_barang.id_barang 
    ORDER BY data_izin.id_izin DESC";
    $result = mysqli_query($conn, $query);
    $mpdf = new \Mpdf\Mpdf();
    $html = '<h1 style="text-align: center;">DATA IZIN EXPORT IMPORT PLBN MOTAMASIN</h1>';
    $html .= '<table border="1" cellspacing="0" cellpadding="5">
                <tr>
                  <th>No</th>
                  <th>Nama PT</th>
                  <th>Nama Penanggung Jawab</th>
                  <th>Nama Pengirim</th>
                  <th>No. Plat Kendaraan</th>
                  <th>Nama Penerima</th>
                  <th>Email</th>
                  <th>No. Telp</th>
                  <th>Alamat</th>
                  <th>Jenis Barang</th>
                  <th>Kategori</th>
                  <th>Kapasitas</th>
                  <th>Tgl Pengiriman</th>
                  <th>Daerah Asal</th>
                  <th>Daerah Tujuan</th>
                  <th>BEA Masuk</th>
                  <th>Total Harga</th>
                </tr>';
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      $tgl_pengiriman = date_create($row["tgl_pengiriman"]);
      $tgl_pengiriman = date_format($tgl_pengiriman, "d M Y");
      $html .= '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $row['nama_pt'] . '</td>
                    <td>' . $row['nama_pj'] . '</td>
                    <td>' . $row['nama_pengirim'] . '</td>
                    <td>' . $row['no_plat'] . '</td>
                    <td>' . $row['nama_penerima'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['no_hp'] . '</td>
                    <td>' . $row['alamat'] . '</td>
                    <td>' . $row['nama_barang'] . '</td>
                    <td>' . $row['nama_kategori'] . '</td>
                    <td>' . $row['kapasitas'] . '</td>
                    <td>' . $tgl_pengiriman . '</td>
                    <td>' . $row['daerah_asal'] . '</td>
                    <td>' . $row['daerah_tujuan'] . '</td>
                    <td>Rp.' . number_format($row['bea_masuk']) . '</td>
                    <td>Rp.' . number_format($row['total_harga']) . '</td>
                 </tr>';
    }
    $html .= '</table>';
    $mpdf->WriteHTML($html);
    $mpdf->Output('data_izin_export_import_plbn_motamasin.pdf', 'D');
  }

  function exportDIToExcel($conn)
  {
    $query = "SELECT data_izin.*, kategori.nama_kategori, data_barang.nama_barang, export_import.kapasitas, export_import.tgl_pengiriman, export_import.daerah_asal, export_import.daerah_tujuan
    FROM data_izin 
    JOIN export_import ON data_izin.id_export_import = export_import.id_export_import 
    JOIN kategori ON export_import.id_kategori = kategori.id_kategori 
    JOIN data_barang ON export_import.id_barang = data_barang.id_barang 
    ORDER BY data_izin.id_izin DESC";
    $result = mysqli_query($conn, $query);
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $spreadsheet->getProperties()->setCreator('Creator')
      ->setLastModifiedBy('Last Modified By')
      ->setTitle('Data Izin Export Import')
      ->setSubject('Data Izin Export Import')
      ->setDescription('Data Izin Export Import')
      ->setKeywords('Data Izin Export Import')
      ->setCategory('Data');
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama PT');
    $sheet->setCellValue('C1', 'Nama Penanggung Jawab');
    $sheet->setCellValue('D1', 'Nama Pengirim');
    $sheet->setCellValue('E1', 'No. Plat Kendaraan');
    $sheet->setCellValue('F1', 'Nama Penerima');
    $sheet->setCellValue('G1', 'Email');
    $sheet->setCellValue('H1', 'No. Telp');
    $sheet->setCellValue('I1', 'Alamat');
    $sheet->setCellValue('J1', 'Barang');
    $sheet->setCellValue('K1', 'Kategori');
    $sheet->setCellValue('L1', 'Kapasitas');
    $sheet->setCellValue('M1', 'Tgl Pengiriman');
    $sheet->setCellValue('N1', 'Daerah Asal');
    $sheet->setCellValue('O1', 'Daerah Tujuan');
    $sheet->setCellValue('P1', 'BEA Masuk');
    $sheet->setCellValue('Q1', 'Total Harga');
    $row = 2;
    $no = 1;
    while ($row_data = mysqli_fetch_assoc($result)) {
      $sheet->setCellValue('A' . $row, $no);
      $sheet->setCellValue('B' . $row, $row_data['nama_pt']);
      $sheet->setCellValue('C' . $row, $row_data['nama_pj']);
      $sheet->setCellValue('D' . $row, $row_data['nama_pengirim']);
      $sheet->setCellValue('E' . $row, $row_data['no_plat']);
      $sheet->setCellValue('F' . $row, $row_data['nama_penerima']);
      $sheet->setCellValue('G' . $row, $row_data['email']);
      $sheet->setCellValue('H' . $row, $row_data['no_hp']);
      $sheet->setCellValue('I' . $row, $row_data['alamat']);
      $sheet->setCellValue('J' . $row, $row_data['nama_barang']);
      $sheet->setCellValue('K' . $row, $row_data['nama_kategori']);
      $sheet->setCellValue('L' . $row, $row_data['kapasitas']);
      $sheet->setCellValue('M' . $row, $row_data['tgl_pengiriman']);
      $sheet->setCellValue('N' . $row, $row_data['daerah_asal']);
      $sheet->setCellValue('O' . $row, $row_data['daerah_tujuan']);
      $sheet->setCellValue('P' . $row, "Rp.".number_format($row_data['bea_masuk']));
      $sheet->setCellValue('Q' . $row, "Rp.".number_format($row_data['total_harga']));
      $row++;
      $no++;
    }
    foreach (range('A', 'O') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = 'data_izin_export_import_plbn_motamasin.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
  }

  function data_izin($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkID = "SELECT * FROM export_import ORDER BY id_export_import DESC LIMIT 1";
      $checkID = mysqli_query($conn, $checkID);
      if (mysqli_num_rows($checkID) > 0) {
        $dataID = mysqli_fetch_assoc($checkID);
        $id_export_import = $dataID['id_export_import'] + 1;
      } else {
        $id_export_import = 1;
      }
      // $checkKode_izin = "SELECT * FROM data_izin WHERE kode_izin='$data[kode_izin]'";
      // $checkKode_izin = mysqli_query($conn, $checkKode_izin);
      // if (mysqli_num_rows($checkKode_izin) > 0) {
      //   $message = "Maaf, kode izin yang anda masukan sudah ada.";
      //   $message_type = "danger";
      //   alert($message, $message_type);
      //   return false;
      // }
      $sql_export_import = "INSERT INTO export_import(id_export_import,id_kategori,id_barang,kapasitas,tgl_pengiriman,daerah_asal,daerah_tujuan) VALUES('$id_export_import','$data[id_kategori]','$data[id_barang]','$data[kapasitas]','$data[tgl_pengiriman]','$data[daerah_asal]','$data[daerah_tujuan]')";
      mysqli_query($conn, $sql_export_import);
      $sql_data_izin = "INSERT INTO data_izin(kode_izin,id_export_import,nama_pt,nama_pj,nama_pengirim,no_plat,nama_penerima,email,no_hp,alamat,bea_masuk,total_harga) VALUES('$data[kode_izin]','$id_export_import','$data[nama_pt]','$data[nama_pj]','$data[nama_pengirim]','$data[no_plat]','$data[nama_penerima]','$data[email]','$data[no_hp]','$data[alamat]','$data[bea_masuk]','$data[total_harga]')";
      mysqli_query($conn, $sql_data_izin);
    }

    if ($action == "update") {
      $sql = "UPDATE data_izin SET kode_izin='$data[kode_izin]', nama_pt='$data[nama_pt]', nama_pj='$data[nama_pj]', nama_pengirim='$data[nama_pengirim]', no_plat='$data[no_plat]', nama_penerima='$data[nama_penerima]', email='$data[email]', no_hp='$data[no_hp]', alamat='$data[alamat]', bea_masuk='$data[bea_masuk]', total_harga='$data[total_harga]' WHERE id_izin='$data[id_izin]'";
      mysqli_query($conn, $sql);
    }

    if ($action == "export") {
      if ($data['format_file'] === "pdf") {
        exportDIToPDF($conn);
      } else if ($data['format_file'] === "excel") {
        exportDIToExcel($conn);
      }
    }

    if ($action == "sending") {
      $check_data = "SELECT data_izin.*, kategori.nama_kategori, data_barang.nama_barang, export_import.kapasitas, export_import.tgl_pengiriman, export_import.daerah_asal, export_import.daerah_tujuan
        FROM data_izin 
        JOIN export_import ON data_izin.id_export_import = export_import.id_export_import 
        JOIN kategori ON export_import.id_kategori = kategori.id_kategori 
        JOIN data_barang ON export_import.id_barang = data_barang.id_barang 
        WHERE data_izin.id_izin='$data[id_izin]'
      ";
      $check_data = mysqli_query($conn, $check_data);
      if (mysqli_num_rows($check_data) > 0) {
        $data = mysqli_fetch_assoc($check_data);
        $token = password_hash($data['email'], PASSWORD_DEFAULT);
        $to       = $data['email'];
        $subject  = "Izin Export Import PLBN MOTAMASIN";
        $message  = "<!doctype html>
            <html>
              <head>
                  <meta name='viewport' content='width=device-width'>
                  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                  <title>Izin Export Import PLBN MOTAMASIN</title>
                  <style>
                      @media only screen and (max-width: 620px) {
                          table[class='body'] h1 {
                              font-size: 28px !important;
                              margin-bottom: 10px !important;}
                          table[class='body'] p,
                          table[class='body'] ul,
                          table[class='body'] ol,
                          table[class='body'] td,
                          table[class='body'] span,
                          table[class='body'] a {
                              font-size: 16px !important;}
                          table[class='body'] .wrapper,
                          table[class='body'] .article {
                              padding: 10px !important;}
                          table[class='body'] .content {
                              padding: 0 !important;}
                          table[class='body'] .container {
                              padding: 0 !important;
                              width: 100% !important;}
                          table[class='body'] .main {
                              border-left-width: 0 !important;
                              border-radius: 0 !important;
                              border-right-width: 0 !important;}
                          table[class='body'] .btn table {
                              width: 100% !important;}
                          table[class='body'] .btn a {
                              width: 100% !important;}
                          table[class='body'] .img-responsive {
                              height: auto !important;
                              max-width: 100% !important;
                              width: auto !important;}}
                      @media all {
                          .ExternalClass {
                              width: 100%;}
                          .ExternalClass,
                          .ExternalClass p,
                          .ExternalClass span,
                          .ExternalClass font,
                          .ExternalClass td,
                          .ExternalClass div {
                              line-height: 100%;}
                          .apple-link a {
                              color: inherit !important;
                              font-family: inherit !important;
                              font-size: inherit !important;
                              font-weight: inherit !important;
                              line-height: inherit !important;
                              text-decoration: none !important;
                          .btn-primary table td:hover {
                              background-color: #d5075d !important;}
                          .btn-primary a:hover {
                              background-color: #000 !important;
                              border-color: #000 !important;
                              color: #fff !important;}}
                  </style>
              </head>
              <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
                  <tr>
                      <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                      <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                      <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
              
                          <!-- START CENTERED WHITE CONTAINER -->
                          <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
              
                          <!-- START MAIN CONTENT AREA -->
                          <tr>
                              <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                              <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                                  <tr>
                                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                      <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Halo " . $data['nama_pt'] . ",</p>
                                      <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Surat izin " . $data['nama_kategori'] . " sudah selesai dibuat. Silakan unduh surat kamu di bawah ini.</p>
                                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                      <tbody>
                                          <tr>
                                          <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                              <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                              <tbody>
                                                  <tr>
                                                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>
                                                      <a href='071598.tugasakhir.my.id/surat-izin?auth=" . $token . "' style='display: inline-block; padding: 10px 20px; font-family: sans-serif; font-size: 14px; font-weight: bold; color: #ffffff; background-color: #007bff; border-radius: 5px; text-decoration: none;'>
                                                          Unduh
                                                      </a>
                                                  </td>
                                                  </tr>
                                              </tbody>
                                              </table>
                                          </td>
                                          </tr>
                                      </tbody>
                                      </table>
                                      <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di PLBN Motamasin.</p>
                                      <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                                  </td>
                                  </tr>
                              </table>
                              </td>
                          </tr>
              
                          <!-- END MAIN CONTENT AREA -->
                          </table>
                          
                          <!-- START FOOTER -->
                          <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                  Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                              </td>
                              </tr>
                          </table>
                          </div>
                          <!-- END FOOTER -->
              
                      <!-- END CENTERED WHITE CONTAINER -->
                      </div>
                      </td>
                      <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  </tr>
                  </table>
              </body>
            </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
      }
    }

    if ($action == "delete") {
      $sql = "DELETE FROM data_izin WHERE id_izin='$data[id_izin]'";
      mysqli_query($conn, $sql);
    }

    return mysqli_affected_rows($conn);
  }

  function exportLaporanExportToPDF($conn)
  {
    $query = "SELECT export_import.*, kategori.id_kategori, data_barang.nama_barang, data_izin.nama_pengirim, data_izin.no_plat, data_izin.nama_penerima 
      FROM export_import 
      JOIN kategori ON export_import.id_kategori=kategori.id_kategori 
      JOIN data_barang ON export_import.id_barang=data_barang.id_barang 
      JOIN data_izin ON export_import.id_export_import=data_izin.id_export_import 
      WHERE kategori.nama_kategori LIKE '%Export%' 
      ORDER BY export_import.id_export_import DESC";
    $result = mysqli_query($conn, $query);
    $mpdf = new \Mpdf\Mpdf();
    $html = '<h1 style="text-align: center;">DATA LAPORAN EXPORT PLBN MOTAMASIN</h1>';
    $html .= '<table border="1" cellspacing="0" cellpadding="5">
                <tr>
                  <th>No</th>
                  <th>Nama Pengirim</th>
                  <th>No. Plat Kendaraan</th>
                  <th>Nama Penerima</th>
                  <th>Barang</th>
                  <th>Kapasitas</th>
                  <th>Tgl Pengiriman</th>
                  <th>Daerah Asal</th>
                  <th>Daerah Tujuan</th>
                </tr>';
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      $tgl_pengiriman = date_create($row["tgl_pengiriman"]);
      $tgl_pengiriman = date_format($tgl_pengiriman, "d M Y");
      $html .= '<tr>
                    <td>' . $no++ . '</td>
                    <td>'. $row['nama_pengirim'] .'</td>
                    <td>'. $row['no_plat'] .'</td>
                    <td>'. $row['nama_penerima'] .'</td>
                    <td>'. $row['nama_barang'] .'</td>
                    <td>'. $row['kapasitas'] .'</td>
                    <td>' . $tgl_pengiriman . '</td>
                    <td>' . $row['daerah_asal'] . '</td>
                    <td>' . $row['daerah_tujuan'] . '</td>
                 </tr>';
    }
    $html .= '</table>';
    $mpdf->WriteHTML($html);
    $mpdf->Output('data_export_plbn_motamasin.pdf', 'D');
  }

  function exportLaporanExportToExcel($conn)
  {
    $query = "SELECT export_import.*, kategori.id_kategori, data_barang.nama_barang, data_izin.nama_pengirim, data_izin.no_plat, data_izin.nama_penerima 
      FROM export_import 
      JOIN kategori ON export_import.id_kategori=kategori.id_kategori 
      JOIN data_barang ON export_import.id_barang=data_barang.id_barang 
      JOIN data_izin ON export_import.id_export_import=data_izin.id_export_import 
      WHERE kategori.nama_kategori LIKE '%Export%' 
      ORDER BY export_import.id_export_import DESC";
    $result = mysqli_query($conn, $query);
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $spreadsheet->getProperties()->setCreator('Creator')
      ->setLastModifiedBy('Last Modified By')
      ->setTitle('Data Export')
      ->setSubject('Data Export')
      ->setDescription('Data Export')
      ->setKeywords('Data Export')
      ->setCategory('Data');
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama Pengirim');
    $sheet->setCellValue('C1', 'No. Plat Kendaraan');
    $sheet->setCellValue('D1', 'Nama Penerima');
    $sheet->setCellValue('E1', 'Barang');
    $sheet->setCellValue('F1', 'Kapasitas');
    $sheet->setCellValue('G1', 'Tgl Pengiriman');
    $sheet->setCellValue('H1', 'Daerah Asal');
    $sheet->setCellValue('I1', 'Daerah Tujuan');
    $row = 2;
    $no = 1;
    while ($row_data = mysqli_fetch_assoc($result)) {
      $sheet->setCellValue('A' . $row, $no);
      $sheet->setCellValue('B' . $row, $row_data['nama_pengirim']);
      $sheet->setCellValue('C' . $row, $row_data['no_plat']);
      $sheet->setCellValue('D' . $row, $row_data['nama_penerima']);
      $sheet->setCellValue('E' . $row, $row_data['nama_barang']);
      $sheet->setCellValue('F' . $row, $row_data['kapasitas']);
      $sheet->setCellValue('G' . $row, $row_data['tgl_pengiriman']);
      $sheet->setCellValue('H' . $row, $row_data['daerah_asal']);
      $sheet->setCellValue('I' . $row, $row_data['daerah_tujuan']);
      $row++;
      $no++;
    }
    foreach (range('A', 'O') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = 'data_export_plbn_motamasin.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
  }

  function export($conn, $data, $action)
  {
    if ($action == "export") {
      if ($data['format_file'] === "pdf") {
        exportLaporanExportToPDF($conn);
      } else if ($data['format_file'] === "excel") {
        exportLaporanExportToExcel($conn);
      }
    }

    // mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function exportLaporanImportToPDF($conn)
  {
    $query = "SELECT export_import.*, kategori.id_kategori, data_barang.nama_barang, data_izin.nama_pengirim, data_izin.no_plat, data_izin.nama_penerima 
      FROM export_import 
      JOIN kategori ON export_import.id_kategori=kategori.id_kategori 
      JOIN data_barang ON export_import.id_barang=data_barang.id_barang 
      JOIN data_izin ON export_import.id_export_import=data_izin.id_export_import 
      WHERE kategori.nama_kategori LIKE '%Import%' 
      ORDER BY export_import.id_export_import DESC";
    $result = mysqli_query($conn, $query);
    $mpdf = new \Mpdf\Mpdf();
    $html = '<h1 style="text-align: center;">DATA LAPORAN IMPORT PLBN MOTAMASIN</h1>';
    $html .= '<table border="1" cellspacing="0" cellpadding="5">
                <tr>
                  <th>No</th>
                  <th>Nama Pengirim</th>
                  <th>No. Plat Kendaraan</th>
                  <th>Nama Penerima</th>
                  <th>Barang</th>
                  <th>Kapasitas</th>
                  <th>Tgl Pengiriman</th>
                  <th>Daerah Asal</th>
                  <th>Daerah Tujuan</th>
                </tr>';
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      $tgl_pengiriman = date_create($row["tgl_pengiriman"]);
      $tgl_pengiriman = date_format($tgl_pengiriman, "d M Y");
      $html .= '<tr>
                    <td>' . $no++ . '</td>
                    <td>'. $row['nama_pengirim'] .'</td>
                    <td>'. $row['no_plat'] .'</td>
                    <td>'. $row['nama_penerima'] .'</td>
                    <td>'. $row['nama_barang'] .'</td>
                    <td>'. $row['kapasitas'] .'</td>
                    <td>' . $tgl_pengiriman . '</td>
                    <td>' . $row['daerah_asal'] . '</td>
                    <td>' . $row['daerah_tujuan'] . '</td>
                 </tr>';
    }
    $html .= '</table>';
    $mpdf->WriteHTML($html);
    $mpdf->Output('data_import_plbn_motamasin.pdf', 'D');
  }

  function exportLaporanImportToExcel($conn)
  {
    $query = "SELECT export_import.*, kategori.id_kategori, data_barang.nama_barang, data_izin.nama_pengirim, data_izin.no_plat, data_izin.nama_penerima 
      FROM export_import 
      JOIN kategori ON export_import.id_kategori=kategori.id_kategori 
      JOIN data_barang ON export_import.id_barang=data_barang.id_barang 
      JOIN data_izin ON export_import.id_export_import=data_izin.id_export_import 
      WHERE kategori.nama_kategori LIKE '%Import%' 
      ORDER BY export_import.id_export_import DESC";
    $result = mysqli_query($conn, $query);
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $spreadsheet->getProperties()->setCreator('Creator')
      ->setLastModifiedBy('Last Modified By')
      ->setTitle('Data Import')
      ->setSubject('Data Import')
      ->setDescription('Data Import')
      ->setKeywords('Data Import')
      ->setCategory('Data');
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama Pengirim');
    $sheet->setCellValue('C1', 'No. Plat Kendaraan');
    $sheet->setCellValue('D1', 'Nama Penerima');
    $sheet->setCellValue('E1', 'Barang');
    $sheet->setCellValue('F1', 'Kapasitas');
    $sheet->setCellValue('G1', 'Tgl Pengiriman');
    $sheet->setCellValue('H1', 'Daerah Asal');
    $sheet->setCellValue('I1', 'Daerah Tujuan');
    $row = 2;
    $no = 1;
    while ($row_data = mysqli_fetch_assoc($result)) {
      $sheet->setCellValue('A' . $row, $no);
      $sheet->setCellValue('B' . $row, $row_data['nama_pengirim']);
      $sheet->setCellValue('C' . $row, $row_data['no_plat']);
      $sheet->setCellValue('D' . $row, $row_data['nama_penerima']);
      $sheet->setCellValue('E' . $row, $row_data['nama_barang']);
      $sheet->setCellValue('F' . $row, $row_data['kapasitas']);
      $sheet->setCellValue('G' . $row, $row_data['tgl_pengiriman']);
      $sheet->setCellValue('H' . $row, $row_data['daerah_asal']);
      $sheet->setCellValue('I' . $row, $row_data['daerah_tujuan']);
      $row++;
      $no++;
    }
    foreach (range('A', 'O') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = 'data_import_plbn_motamasin.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
  }

  function import($conn, $data, $action)
  {
    if ($action == "export") {
      if ($data['format_file'] === "pdf") {
        exportLaporanImportToPDF($conn);
      } else if ($data['format_file'] === "excel") {
        exportLaporanImportToExcel($conn);
      }
    }

    // mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function exportLaporanKeuanganToPDF($conn)
  {
    $query = "SELECT * FROM keuangan ORDER BY id_keuangan DESC";
    $result = mysqli_query($conn, $query);
    $mpdf = new \Mpdf\Mpdf();
    $html = '<h1 style="text-align: center;">DATA KEGIATAN KEPABEANAN PLBN MOTAMASIN <br>'.date('M Y').'</h1>';
    $html .= '<table border="1" cellspacing="0" cellpadding="5">
                <tr>
                  <th rowspan="2">No</th>
                  <th rowspan="2">Tanggal</th>
                  <th colspan="6">Ekspor (BC 3.0)</th>
                  <th colspan="5">Impor (BC 2.0)</th>
                </tr>
                <tr>
                  <th>Jumlah PEB</th>
                  <th>Netto (KG)</th>
                  <th>Devisa (USD)</th>
                  <th>Devisa (RP)</th>
                  <th>Komoditi</th>
                  <th>Sarana Angkut</th>
                  <th>Jumlah PIB</th>
                  <th>Bruto (KG)</th>
                  <th>Penerimaan Bea Masuk (RP)</th>
                  <th>Komoditi</th>
                  <th>Sarana Angkut</th>
                </tr>';
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      $created_at = date_create($row["created_at"]);
      $created_at = date_format($created_at, "d M Y");
      $html .= '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $created_at . '</td>
                    <td>'. $row['jumlah_peb'] .'</td>
                    <td>'. $row['netto'] .' kg</td>
                    <td>$.' . number_format($row['devisa_usd']) . '</td>
                    <td>Rp.' . number_format($row['devisa_rp']) . '</td>
                    <td>'. $row['komoditi_ekspor'] .'</td>
                    <td>' . $row['sarana_angkut_ekspor'] . '</td>
                    <td>' . $row['jumlah_pib'] . '</td>
                    <td>' . $row['bruto'] . ' kg</td>
                    <td>Rp.' . number_format($row['bea_masuk']) . '</td>
                    <td>' . $row['komoditi'] . '</td>
                    <td>' . $row['sarana_angkut_impor'] . '</td>
                 </tr>';
    }
    $html .= '</table>';
    $mpdf->WriteHTML($html);
    $mpdf->Output('data_kegiatan_kepabeanan_plbn_motamasin.pdf', 'D');
  }

  function exportLaporanKeuanganToExcel($conn)
  {
    $query = "SELECT * FROM keuangan ORDER BY id_keuangan DESC";
    $result = mysqli_query($conn, $query);
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $spreadsheet->getProperties()->setCreator('Creator')
      ->setLastModifiedBy('Last Modified By')
      ->setTitle('Data Import')
      ->setSubject('Data Import')
      ->setDescription('Data Import')
      ->setKeywords('Data Import')
      ->setCategory('Data');
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Tanggal');
    $sheet->setCellValue('C1', 'Jumlah PEB');
    $sheet->setCellValue('D1', 'Netto (KG)');
    $sheet->setCellValue('E1', 'Devisa (USD)');
    $sheet->setCellValue('F1', 'Devisa (RP)');
    $sheet->setCellValue('G1', 'Komoditi Ekspor');
    $sheet->setCellValue('H1', 'Sarana Angkut Ekspor');
    $sheet->setCellValue('I1', 'Jumlah PIB');
    $sheet->setCellValue('J1', 'Bruto (KG)');
    $sheet->setCellValue('K1', 'Penerimaan Bea Masuk (RP)');
    $sheet->setCellValue('L1', 'Komoditi');
    $sheet->setCellValue('M1', 'Sarana Angkut');
    $row = 2;
    $no = 1;
    while ($row_data = mysqli_fetch_assoc($result)) {
      $created_at = date_create($row_data["created_at"]);
      $created_at = date_format($created_at, "d M Y");
      $sheet->setCellValue('A' . $row, $no);
      $sheet->setCellValue('B' . $row, $created_at);
      $sheet->setCellValue('C' . $row, $row_data['jumlah_peb']);
      $sheet->setCellValue('D' . $row, $row_data['netto']." kg");
      $sheet->setCellValue('E' . $row, "$.".number_format($row_data['devisa_usd']));
      $sheet->setCellValue('F' . $row, "Rp.".number_format($row_data['devisa_rp']));
      $sheet->setCellValue('G' . $row, $row_data['komoditi_ekspor']);
      $sheet->setCellValue('H' . $row, $row_data['sarana_angkut_ekspor']);
      $sheet->setCellValue('I' . $row, $row_data['jumlah_pib']);
      $sheet->setCellValue('J' . $row, $row_data['bruto']." kg");
      $sheet->setCellValue('K' . $row, "Rp.".number_format($row_data['bea_masuk']));
      $sheet->setCellValue('L' . $row, $row_data['komoditi_impor']);
      $sheet->setCellValue('M' . $row, $row_data['sarana_angkut_impor']);
      $row++;
      $no++;
    }
    foreach (range('A', 'K') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = 'data_laporan_keuangan_bea_masuk_plbn_motamasin.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
  }

  function keuangan($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO keuangan(jumlah_peb,netto,devisa_usd,devisa_rp,komoditi_ekspor,sarana_angkut_ekspor,jumlah_pib,bruto,bea_masuk,komoditi_impor,sarana_angkut_impor) VALUES('$data[jumlah_peb]','$data[netto]','$data[devisa_usd]','$data[devisa_rp]','$data[komoditi_ekspor]','$data[sarana_angkut_ekspor]','$data[jumlah_pib]','$data[bruto]','$data[bea_masuk]','$data[komoditi_impor]','$data[sarana_angkut_impor]')";
    }

    if ($action == "update") {
      $sql = "UPDATE keuangan SET jumlah_peb='$data[jumlah_peb]', netto='$data[netto]', devisa_usd='$data[devisa_usd]', devisa_rp='$data[devisa_rp]', komoditi_ekspor='$data[komoditi_ekspor]', sarana_angkut_ekspor='$data[sarana_angkut_ekspor]', jumlah_pib='$data[jumlah_pib]', bruto='$data[bruto]', bea_masuk='$data[bea_masuk]', komoditi_impor='$data[komoditi_impor]', sarana_angkut_impor='$data[sarana_angkut_impor]' WHERE id_keuangan='$data[id_keuangan]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM keuangan WHERE id_keuangan='$data[id_keuangan]'";
    }

    if ($action == "export") {
      if ($data['format_file'] === "pdf") {
        exportLaporanKeuanganToPDF($conn);
      } else if ($data['format_file'] === "excel") {
        exportLaporanKeuanganToExcel($conn);
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }
  
  function __name($conn, $data, $action)
  {
    if ($action == "insert") {
    }

    if ($action == "update") {
    }

    if ($action == "delete") {
    }

    // mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }
}
