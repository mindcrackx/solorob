<?php
function sql_lieferant_anlegen(
    $mysqli,
    $firmenname,
    $strasse,
    $plz,
    $ort,
    $tel,
    $mobil,
    $fax,
    $email
)
{
    $sql = "insert into tbl_lieferant(l_firmenname, l_strasse, l_plz, l_ort, l_tel, l_mobil, l_fax, l_email)
    values (?, ?, ?, ?, ?, ?, ?, ?)";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "ssssssss",
        $firmenname,
        $strasse,
        $plz,
        $ort,
        $tel,
        $mobil,
        $fax,
        $email
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}

function sql_lieferant_list(
    $mysqli,
    $startNum,
    $howMany
)
{
    $sql = "select * from tbl_lieferant limit ?, ?;";
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
    return $stmt->get_result();
}

function sql_lieferant_delete(
    $mysqli,
    $l_id
)
{
    $sql = "delete from tbl_lieferant where l_id = ?;";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $l_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}

function sql_lieferant_update(
    $mysqli,
    $l_id,
    $firmenname,
    $strasse,
    $plz,
    $ort,
    $tel,
    $mobil,
    $fax,
    $email
)
{
    $sql = "update tbl_lieferant set l_firmenname = ?, l_strasse = ?, l_plz = ?, l_ort = ?, l_tel = ?, l_mobil = ?, l_fax = ?, l_email = ? where l_id = ?;";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "ssssssssi",
        $firmenname,
        $strasse,
        $plz,
        $ort,
        $tel,
        $mobil,
        $fax,
        $email,
        $l_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}
?>