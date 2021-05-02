<?php

require 'db.php';

$DBO = new DB();
$DBO->DBConnect();

$states_list = $DBO->getStates();

$DBO->DBClose();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        .error {
            color: red;
        }

    </style>

</head>
<body>

<div class="container">

<div class="col-4 mt-5">

    <form method="POST" id="feedback-form" action="operations.php?actions=addFeedback" autocomplete="off">

    <div class="mb-3">
        <label for="Name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name">
    </div>

    <div class="mb-3">
        <label for="State" class="form-label">State</label>
        <select class="form-control" name="state" id="state">
        <option value="" selected>Select State</option>
        <?php for ($i=0; $i<count($states_list); $i++) { ?>
            <option value="<?php echo $states_list[$i]['id']; ?>"><?php echo $states_list[$i]['state_name']; ?></option>
        <?php } ?>    
        </select>
    </div>

    <div class="mb-3">
        <label for="City" class="form-label">City</label>
        <select class="form-control" name="city" id="city">
            <option value="" selected>Select City</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="Feedback" class="form-label">Feedback</label>
        <textarea class="form-control" name="feedback" id="feedback"></textarea>
    </div>    
    
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

    $(function() {

        $('#feedback-form').validate({

            rules: {
                name: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                feedback: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Enter Name."
                },
                state: {
                    required: "Select State."
                },
                city: {
                    required: "Select City."
                },
                feedback: {
                    required: "Enter Feedback."
                }
            },
            submitHandler:function(form) {
                form.submit();
            }

        });

    });

    $(document).ready(function() {

         $('#state').change(function() {

            var state_id = $(this).val();
            
            $.ajax({
                url: 'operations.php',
                type: 'POST',
                data: {actions: 'getCities', state_id: state_id},
                dataType: 'JSON',
                success:function(data) {
                    // console.log(data);
                    $('#city').html(data);
                }
            });

         });

    });

</script>

</body>
</html>