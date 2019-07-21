<?php
function sql_komponente_create(
    $mysqli,
    $bezeichnung,
    $raeume_r_id,
    $lieferant_l_id,
    $einkaufsdatum,
    $gewaehrleistungsdauer,
    $notiz,
    $hersteller,
    $komponentenarten_ka_id
)
{
    $sql = "insert into tbl_komponenten(k_bezeichnung, raeume_r_id, lieferant_l_id, k_einkaufsdatum, k_gewaehrleistungsdauer, k_notiz, k_hersteller, komponentenarten_ka_id)
    values (?, ?, ?, ?, ?, ?, ?, ?)";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "siisissi",
        $bezeichnung,
        $raeume_r_id,
        $lieferant_l_id,
        $einkaufsdatum,
        $gewaehrleistungsdauer,
        $notiz,
        $hersteller,
        $komponentenarten_ka_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}

function sql_raeume_list(
    $mysqli,
    $startNum,
    $howMany
)
{
    $sql = "select * from raeume limit ?, ?";
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

function sql_raeume_delete(
    $mysqli,
    $r_id
)
{
    $sql = "delete from tbl_raeume where r_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $r_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    #result = $stmt->fetch_all(MYSQLI_ASSOC);
    return $stmt->get_result();
}

function sql_raeume_update(
    $mysqli,
    $r_id,
    $nr,
    $bezeichnung,
    $notiz
)
{
    $sql = "update tbl_raeume set r_nr = ?, r_bezeichnung = ?, r_notiz = ? where r_id = ?;";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "sssi",
        $nr,
        $bezeichnung,
        $notiz,
        $r_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}
?>
