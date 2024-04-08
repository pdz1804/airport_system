<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['ownerid'])){
	$qry = $conn->query("SELECT * FROM Cooperation JOIN Owner ON Cooperation.OwnerID = Owner.OwnerID where Cooperation.OwnerID = '".$_GET['ownerid']."'")->fetch_array();
    foreach($qry as $k => $v){
        $$k = $v;
    }
}
?>

<!--
CREATE TABLE Owner
(
    OwnerID INT AUTO_INCREMENT,
    Phone   CHAR(10),
    PRIMARY KEY (OwnerID)
);

CREATE TABLE Cooperation
(
    Name    VARCHAR(50),
    Address VARCHAR(50),
    OwnerID INT,
    PRIMARY KEY (Name),
    FOREIGN KEY (OwnerID) REFERENCES Owner (OwnerID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Person
(
    SSN     CHAR(10),
    Name    VARCHAR(50),
    Address VARCHAR(50),
    OwnerID INT,
    PRIMARY KEY (SSN),
    FOREIGN KEY (OwnerID) REFERENCES Owner (OwnerID) ON DELETE CASCADE ON UPDATE CASCADE
);
-->

<div class="col-lg-12">
    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-info">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <dl>
                                <dt><b class="border-bottom border-primary">Cooperation ID</b></dt>
                                <dd><?php echo ucwords($OwnerID) ?></dd>
                            </dl>
                            <dl>
                                <dt><b class="border-bottom border-primary">Cooperation Name</b></dt>
                                <dd><?php echo ucwords($Name) ?></dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl>
                                <dt><b class="border-bottom border-primary">Cooperation Address</b></dt>
                                <dd><?php echo ucwords($Address) ?></dd>
                            </dl>
                            <dl>
                                <dt><b class="border-bottom border-primary">Cooperation Phone</b></dt>
                                <dd><?php echo ucwords($Phone) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <span><b>Airplane List:</b></span>
                    <?php if($_SESSION['login_type'] != 3): ?>
                    <!-- <div class="card-tools">
                        <button class="btn btn-primary bg-gradient-primary btn-sm" type="button" id="new_task"><i
                                class="fa fa-plus"></i> New Task</button>
                    </div> -->
                    <?php endif; ?>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-condensed m-0 table-hover">
                            <colgroup>
                                <col width="10%">
                                <col width="25%">
                                <col width="25%">
                                <col width="15%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                                <th>ID</th>
                                <th>License Plate Number</th>
                                <th>Owner ID</th>
                                <th>Leased Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                // $tasks = $conn->query("SELECT * FROM task_list where project_id = {$id} order by task asc");
                                // Airport_Contains_Airplane 
                                $airplanes = $conn->query("SELECT * FROM Airplane JOIN Owner ON Airplane.OwnerID = Owner.OwnerID JOIN Cooperation ON Airplane.OwnerID = Cooperation.OwnerID where Airplane.OwnerID = '".$_GET['ownerid']."'");

                                // Airport_Includes_Employee
                                // $employees = $conn->query("SELECT * FROM Airport_Includes_Employee JOIN Employee ON Airport_Includes_Employee.SSN = Employee.SSN  where APCode = {$apcode}");
                                $i++;
                                while($row=$airplanes->fetch_assoc()):
                                    // $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                                    // unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                                    // $desc = strtr(html_entity_decode($row['description']),$trans);
                                    // $desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
                                ?>
                                <tr>
                                    <td class=""><?php echo $row['AirplaneID'] ?></td>
                                    <td class=""><b><?php echo ucwords($row['License_plate_num']) ?></b></td>
                                    <td class="">
                                        <p class="truncate"><?php echo strip_tags($row['OwnerID']) ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo date("F d, Y",strtotime($row['LeasedDate'])) ?></p>
                                    </td>
                                    <td class="text-center">
                                        <button type="button"
                                            class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="true">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item view_airplane"
                                                href="./index.php?page=view_airplane&id=<?php echo $row['AirplaneID'] ?>"
                                                data-id="<?php echo $row['AirplaneID'] ?>">View</a>

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item"
                                                href="./index.php?page=edit_airplane&airplaneid=<?php echo $row["AirplaneID"]; ?>">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete_airplane" href="javascript:void(0)"
                                                data-id="<?php echo $row['AirplaneID'] ?>">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php 
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.truncate {
    -webkit-line-clamp: 1 !important;
}
</style>
<script>
$(document).ready(function() {
    $('#list').dataTable()

    // NOTE HONG XOA
    // $('.view_airplane').click(function() {
    //     window.location.href = "view_airplane.php?id=" + $(this).attr('data-id');
    // })

    // $('.delete_airplane').click(function() {
    //     _conf("Are you sure to delete this Airplane?", "delete_airplane", [$(this).attr(
    //         'data-id')])
    // })
    $(document).on('click', '.view_airplane', function() {
        window.location.href = "view_airplane.php?id=" + $(this).attr('data-id');
    });

    $(document).on('click', '.delete_airplane', function() {
        _conf_str("Are you sure to delete this Airplane?", "delete_airplane", [$(this).attr(
            'data-id')]);
    });
})

function delete_airplane($airplaneid) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_airplane',
        method: 'POST',
        data: {
            airplaneid: $airplaneid
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)
            } else {
                alert_toast('Data failed to delete.', "error");
                setTimeout(function() {
                    // location.replace('index.php?page=list_airplane')
                    location.replace('index.php?page=view_airplane&id='.$_GET['id'])
                }, 750)
            }
        }
    })
}
</script>