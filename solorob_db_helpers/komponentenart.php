<?php
function sql_komponentenart_anlegen(
    $mysqli,
    $komponentenart
)
{
    $sql = "insert into tbl_komponentenarten(ka_komponentenart) values (?)";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "s",
        $komponentenart
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->insert_id;
}

function sql_komponentenart_list(
    $mysqli,
    $startNum,
    $howMany
)
{
    $sql = "select * from tbl_komponentenarten limit ?, ?";
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

function sql_komponentenart_list_one(
    $mysqli,
    $komponentenart_id
)
{
    $sql = "select * from tbl_komponentenarten where ka_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $komponentenart_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}

function sql_komponentenart_delete(
    $mysqli,
    $ka_id
)
{
    $sql = "delete from tbl_komponentenarten where ka_id = ?";
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

function sql_komponentenart_update(
    $mysqli,
    $ka_id,
    $komponentenart
)
{
    $sql = "update tbl_komponentenarten set ka_komponentenart = ? where ka_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "si",
        $komponentenart,
        $ka_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}

function sql_komponentenart_list_all(
    $mysqli
)
{
    $sql = "select * from tbl_komponentenarten";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}


function sql_komponentenart_komponentenattribut_verknüpfen(
    $mysqli,
    $komponentenart_id,
    $komponentenattribut_id
)
{
    $sql = "insert into tbl_wird_beschrieben_durch (komponentenarten_ka_id, komponentenattribute_kat_id)
    values (?, ?)";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "ii",
        $komponentenart_id,
        $komponentenattribut_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}


function sql_komponentenart_delete_wird_beschrieben_durch(
    $mysqli,
    $komponentenart_id
)
{
    $sql = "delete from tbl_wird_beschrieben_durch where komponentenarten_ka_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $komponentenart_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}



function sql_komponentenart_get_wird_beschrieben_durch(
    $mysqli,
    $komponentenart_id
)
{
    $sql = "select * from tbl_wird_beschrieben_durch where komponentenarten_ka_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $komponentenart_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}
?>

