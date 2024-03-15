<?php
session_start();
if (!isset($_SESSION['value'])) {
    $_SESSION['value'] = "";
}
if (!isset($_SESSION['from_currency'])) {
    $_SESSION['from_currency'] = "FUSD";
}
if (!isset($_SESSION['to_currency'])) {
    $_SESSION['to_currency'] = "TUSD";
}
$rates = array(
    "FUSD" => array(
        "TUSD" => 1.0,
        "TCAD" => 1.3,
        "TEUR" => 0.9
    ),
    "FCAD" => array(
        "TUSD" => 0.8,
        "TCAD" => 1.0,
        "TEUR" => 0.7
    ),
    "FEUR" => array(
        "TUSD" => 1.0,
        "TCAD" => 1.4,
        "TEUR" => 0.9
    ),
);

$converted_value = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION['value'] = $_GET['value'];
    $_SESSION['from_currency'] = $_GET['from_currency'];
    $_SESSION['to_currency'] = $_GET['to_currency'];

    $from_currency = $_SESSION['from_currency'];
    $to_currency = $_SESSION['to_currency'];
    $value = $_SESSION['value'];

    if (isset($rates[$from_currency][$to_currency])) {
        $conversion_rate = $rates[$from_currency][$to_currency];
        $converted_value = $value * $conversion_rate;
    } else {
        $converted_value = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Java Jam Coffee House</title>
    <meta name="description" content="CENG 311 Inclass Activity 4" />
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <table>
            <tr>
                <td>From:</td>
                <td><input type="text" name="value" value="<?php echo $_SESSION['value']; ?>" /></td>
                <td>Currency:</td>
                <td>
                    <select name="from_currency">
                        <option value="FUSD" <?php if($_SESSION['from_currency'] == 'FUSD') echo 'selected'; ?>>USD</option>
                        <option value="FCAD" <?php if($_SESSION['from_currency'] == 'FCAD') echo 'selected'; ?>>CAD</option>
                        <option value="FEUR" <?php if($_SESSION['from_currency'] == 'FEUR') echo 'selected'; ?>>EUR</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>To:</td>
                <td><input type="text" name="converted_value" value="<?php echo $converted_value; ?>" readonly /></td>
                <td>Currency:</td>
                <td>
                    <select name="to_currency">
                        <option value="TUSD" <?php if($_SESSION['to_currency'] == 'TUSD') echo 'selected'; ?>>USD</option>
                        <option value="TCAD" <?php if($_SESSION['to_currency'] == 'TCAD') echo 'selected'; ?>>CAD</option>
                        <option value="TEUR" <?php if($_SESSION['to_currency'] == 'TEUR') echo 'selected'; ?>>EUR</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="submit" value="convert" /></td>
            </tr>
        </table>
    </form>

</body>
</html>
