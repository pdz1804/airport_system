<?php include'db_connect.php' ?>
<div class="col-lg-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary"
                    href="./index.php?page=new_flight"><i class="fa fa-plus"></i> Add New Flight</a>
            </div>
        </div>
        <!-- AirplaneID INT AUTO_INCREMENT,
        License_plate_num VARCHAR(7) UNIQUE NOT NULL,
        AirlineID CHAR(3) NOT NULL,
        OwnerID INT NOT NULL,
        ModelID INT,
        LeasedDate TIMESTAMP NOT NULL,
        MName VARCHAR(50), -->
        <div class="card-body">
            <table class="table table-hover table-bordered" id="list">
                <thead>
                    <tr>
                        <th>Flight ID</th>
                        <th>Status</th>
                        <th>Flight Code</th>
                        <th>Expected Arrive Time</th>
                        <th>Expected Depart Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM Flight order by FlightID asc");
                    $i++;
					while($row= $qry->fetch_assoc()):
					?>
                    <tr>
                        <td><b><?php echo $row['FlightID'] ?></b></td>
                        <td><b><?php echo $row['Status'] ?></b></td>
                        <td><b><?php echo $row['FlightCode'] ?></b></td>
                        <td><b><?php echo $row['ExpectedArrTime'] ?></b></td>
                        <td><b><?php echo $row['ExpectedDepTime'] ?></b></td>
                        <td class="text-center">
                            <button type="button"
                                class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle"
                                data-toggle="dropdown" aria-expanded="true">
                                Action
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item view_flight"
                                    href="./index.php?page=view_flight&id=<?php echo $row['FlightID'] ?>"
                                    data-id="<?php echo $row['FlightID'] ?>">View</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                    href="./index.php?page=edit_flight&flightid=<?php echo $row["FlgithID"]; ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_flight" href="javascript:void(0)"
                                    data-id="<?php echo $row['FlightID'] ?>">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#list').dataTable()

    // $('.view_flight').click(function() {
    //     window.location.href = "view_flight.php?id=" + $(this).attr('data-id');
    // })

    // $('.delete_flight').click(function() {
    //     _conf("Are you sure to delete this Flight?", "delete_flight", [$(this).attr(
    //         'data-id')])
    // })
    $(document).on('click', '.view_flight', function() {
        window.location.href = "view_flight.php?id=" + $(this).attr('data-id');
    });

    $(document).on('click', '.delete_flight', function() {
        _conf_str("Are you sure to delete this Flight?", "delete_flight", [$(this).attr(
            'data-id')]);
    });
})

function delete_flight($flightid) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_flight',
        method: 'POST',
        data: {
            flightid: $flightid
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)
            } else {
                alert_toast('Data failed to delete.', "fail");
                setTimeout(function() {
                    location.replace('index.php?page=list_flight')
                }, 75000)
            }
        }
    })
}
</script>