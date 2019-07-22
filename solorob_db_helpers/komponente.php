<?php
function sql_komponente_anlegen(
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

function sql_komponente_list(
    $mysqli,
    $startNum,
    $howMany
)
{
    $sql = "select * from tbl_komponenten limit ?, ?";
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

function sql_komponente_delete(
    $mysqli,
    $k_id
)
{
    $sql = "delete from tbl_komponenten where k_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $k_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    #result = $stmt->fetch_all(MYSQLI_ASSOC);
    return $stmt->get_result();
}

function sql_komponente_update(
    $mysqli,
    $k_id,
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
    $sql = "update tbl_komponenten set k_bezeichnung = ?, raeume_r_id = ?, lieferant_l_id = ?, k_einkaufsdatum = ?, k_gewaehrleistungsdauer = ?, k_notiz = ?, k_hersteller = ?, komponentenarten_ka_id = ? where k_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "siisissii",
        $bezeichnung,
        $raeume_r_id,
        $lieferant_l_id,
        $einkaufsdatum,
        $gewaehrleistungsdauer,
        $notiz,
        $hersteller,
        $komponentenarten_ka_id,
        $k_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    return $stmt->get_result();
}


function sql_komponente_zum_austauschen(
    $mysqli,
    $komponentenarten_ka_id,
    $startNum,
    $howMany
)
{
    $sql = "select * from tbl_komponenten where komponentenarten_ka_id = ? limit ?, ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "iii",
        $komponentenarten_ka_id,
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

function sql_komponente_austauschen(
    $mysqli,
    $new_k_id,
    $old_k_id
)
{
    # get raume_r_id from the "old" component to transfer new component into
    $sql = "select raeume_r_id from tbl_komponenten where k_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $old_k_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $result = $stmt->get_result();
    $raeume_r_id_zum_austauschen = $result->fetch_assoc()["raeume_r_id"];

    # old komponent gets put into "Lager"
    $sql = "update tbl_komponenten set raeume_r_id = 2 where k_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "i",
        $old_k_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    $sql = "update tbl_komponenten set raeume_r_id = ? where k_id = ?";
    if (!($stmt = $mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->bind_param(
        "ii",
        $raeume_r_id_zum_austauschen,
        $old_k_id
    )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    #result = $stmt->fetch_all(MYSQLI_ASSOC);
    return $stmt->get_result();
}
?>
