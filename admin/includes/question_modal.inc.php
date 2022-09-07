
<!-- Modal for adding questions -->
<div class="modal fade" id="quesAddModal" tabindex="-1" aria-labelledby="quesAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quesAddModalLabel">Add question</h5>
            </div>
            <div class="modal-body">
                <form action="includes/add.inc.php" method="post" autocomplete="off" id="quesAddForm">
                    <input type="hidden" name="quizid" value="<?php echo $_GET['quizid']; ?>">
                    <input class="form-control" type="text" name="ques_name" placeholder="Question">
                    <input class="form-control" type="text" name="opt1" placeholder="Option 1">
                    <input class="form-control" type="text" name="opt2" placeholder="Option 2">
                    <input class="form-control" type="text" name="opt3" placeholder="Option 3">
                    <input class="form-control" type="text" name="opt4" placeholder="Option 4">

                    <input class="form-control" type="text" name="opt_ans" placeholder="Correct Option number(1-4)">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary" value="add_question" form="quesAddForm">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- ###################################################### -->
<!-- Modal for modifying questions -->
<div class="modal fade" id="quesModifyModal" tabindex="-1" aria-labelledby="quesModifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quesModifyModalLabel">Modify question</h5>
            </div>
            <div class="modal-body">
                <form action="includes/modify.inc.php" method="post" autocomplete="off" id="quesModifyForm">

                    <input type="hidden" name="qid" id='qid'>
                    <input type="hidden" name="quizid" id='quizid'>

                    <input class="form-control" type="text" name="ques_name" id="ques_name" placeholder="Question">
                    <input class="form-control" type="text" name="opt1" id="opt1" placeholder="Option 1">
                    <input class="form-control" type="text" name="opt2" id="opt2" placeholder="Option 2">
                    <input class="form-control" type="text" name="opt3" id="opt3" placeholder="Option 3">
                    <input class="form-control" type="text" name="opt4" id="opt4" placeholder="Option 4">

                    <input class="form-control" type="text" name="opt_ans" id="opt_ans" placeholder="Correct Option number(1-4)">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary" value="mod_question" form="quesModifyForm">Modify</button>
            </div>
        </div>
    </div>
</div>

<!-- Calling modify modal when 'modify' button is pressed-->
<script>
$(document).ready(function(){
    $('.modbtn').on('click', function(){
        $form = document.getElementById('quesModifyForm');

        $tr= $(this).closest('tr');
        
        var ques=$tr.children('td').map(function(){
            return $(this).text();
        }).get();
        console.log(ques);
        $form.ques_name.value = ques[0];
        
        var data=$tr.children('input').map(function(){
            return $(this).val();
        }).get();
        console.log(data);
        
        $form.qid.value = data[0];
        $form.quizid.value = data[1];
        $form.opt1.value = data[2];
        $form.opt2.value = data[3];
        $form.opt3.value = data[4];
        $form.opt4.value = data[5];
        $form.opt_ans.value = data[6];
        
        $('#quesModifyModal').modal('show');
    });
})
</script>

<!-- ###################################################### -->
<!-- Modal for deleting questions -->
<div class="modal fade" id="quesDeleteModal" tabindex="-1" aria-labelledby="quesDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quesDeleteModalLabel">Delete question?</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the question?</p>
                <p>This will delete all relevant info related to the questions too.</p>
                <form method="post" action="includes/delete.inc.php" id="quesDeleteForm">
                    <input type = "hidden" name="qid" id="qid">
                    <input type="hidden" name="quizid" id='quizid'>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-danger" value="del_question" form="quesDeleteForm">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Script to link to delete modal -->
<script>
$(document).ready(function(){
    $('.delbtn').on('click', function(){
        
        $form = document.getElementById("quesDeleteForm");
        $tr= $(this).closest('tr');
               
        var data=$tr.children('input').map(function(){
            return $(this).val();
        }).get();
        console.log(data);
        
        $form.qid.value = data[0];
        $form.quizid.value = data[1];
        $('#quesDeleteModal').modal('show');
    });
})
</script>
