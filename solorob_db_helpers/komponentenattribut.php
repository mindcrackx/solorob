<?php
function sql_komponentenattribut_anlegen(
    $mysqli,
    $komponentenattribut
)
{
    $sql = "insert into tbl_komponentenattribute(kat_bezeichnung) values (?)";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "s",
        $komponentenattribut
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}

function sql_komponentenattribut_list(
    $mysqli,
    $startNum,
    $howMany
)
{
    $sql = "select * from tbl_komponentenattribute limit ?, ?";
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

function sql_komponentenattribut_delete(
    $mysqli,
    $kat_id
)
{
    $sql = "delete from tbl_komponentenattribute where kat_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $kat_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    #result = $stmt->fetch_all(MYSQLI_ASSOC);
    return $stmt->get_result();
}

function sql_komponentenattribut_update(
    $mysqli,
    $kat_id,
    $komponentenattribut
)
{
    $sql = "update tbl_komponentenattribute set kat_bezeichnung = ? where kat_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "si",
        $komponentenattribut,
        $kat_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}


function sql_komponentenattribut_list_one(
    $mysqli,
    $kat_id
)
{
    $sql = "select * from tbl_komponentenattribute where kat_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $kat_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    #result = $stmt->fetch_all(MYSQLI_ASSOC);
    return $stmt->get_result();
}

function sql_komponentenattribute_by_komponentenart(
    $mysqli,
    $ka_id
)
{
    $sql = "select kat.kat_id, kat.kat_bezeichnung from tbl_wird_beschrieben_durch as wbd
    inner join tbl_komponentenattribute as kat on kat.kat_id = wbd.komponentenattribute_kat_id
    where wbd.komponentenarten_ka_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $ka_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    #result = $stmt->fetch_all(MYSQLI_ASSOC);
    return $stmt->get_result();
}


function sql_komponentenattribut_fuer_komponente_anlegen(
    $mysqli,
    $komponente_id,
    $komponentenattribut_id,
    $komponentenattribut_wert
)
{
    $sql = "insert into tbl_komponente_hat_attribute (komponenten_k_id, komponentenattribute_kat_id, khkat_wert)
    values (?, ?, ?)";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "iis",
        $komponente_id,
        $komponentenattribut_id,
        $komponentenattribut_wert
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}
?>


