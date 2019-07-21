<?php
function sql_benutzer_anlegen(
    $mysqli,
    $name,
    $vorname,
    $nickname,
    $password,
    $rechte_rolle_id
)
{
    $sql = "insert into tbl_benutzer(b_name, b_vorname, b_nickname, b_password, b_rechte_rolle_id)
    values (?, ?, ?, ?, ?)";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "ssssi",
        $name,
        $vorname,
        $nickname,
        $password,
        $rechte_rolle_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}

function sql_benutzer_list(
    $mysqli,
    $startNum,
    $howMany
)
{
    $sql = "select * from tbl_benutzer limit ?, ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "ii",
        $startNum,
        $howMany
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    #result = $stmt->fetch_all(MYSQLI_ASSOC);
    return $stmt->get_result();
}

function sql_benutzer_delete(
    $mysqli,
    $b_id
)
{
    $sql = "delete from tbl_benutzer where b_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $b_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    #result = $stmt->fetch_all(MYSQLI_ASSOC);
    return $stmt->get_result();
}

function sql_benutzer_update(
    $mysqli,
    $b_id,
    $name,
    $vorname,
    $nickname,
    $password,
    $rechte_rolle_id
)
{
    $sql = "update tbl_benutzer set b_name = ?, b_vorname = ?, b_nickname = ?, b_password = ?, b_rechte_rolle_id = ? where b_id = ?;";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "ssssii",
        $name,
        $vorname,
        $nickname,
        $password,
        $rechte_rolle_id,
        $b_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}
?>
