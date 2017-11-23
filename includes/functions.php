<?php
function sql_dropdown2($fieldname, $sqlid, $first, $second, $table, $mysqli) {
    $queryMultiselect = "select " . $sqlid . "," . $first . "," . $second . " FROM " . $table . " order by " . $first . ";";
    $result = mysqli_query($mysqli, $queryMultiselect) or die();
    echo "<select name = " . $fieldname . " id='multiselect_$fieldname'>";
    while ($row = mysqli_fetch_row($result)) {
        echo "<option name= '" . $row[1] . " " . $row[2] . "' value=" . $row[0] . ">" . $row[1] . " " . $row[2] . "</option>";
    }
    echo "</select>";
}
?>

<?php
function sql_dropdown($fieldname, $sqlid, $displayfield, $where, $whereclause, $table, $mysqli) {
    $queryMultiselect = "select " . $sqlid . "," . $displayfield . " FROM " . $table . " where ".$where." = '".$whereclause."' order by " . $displayfield . ";";
    $result = mysqli_query($mysqli, $queryMultiselect) or die();
    echo "<select name = " . $fieldname . " id='multiselect_$fieldname'>";
    while ($row = mysqli_fetch_row($result)) {
        echo "<option name= '" . $row[1] . "' value=" . $row[0] . ">" . $row[1] . "</option>";
    }
    echo "</select>";
}
?>