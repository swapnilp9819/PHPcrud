<!-- Form modal -->
<div class="modal fade" id="addemployee">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="addform" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <!-- Name -->
                    <label>Name: </label>
                    <div class="input-group mb-3 py-1">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" autocomplete="off" required="required">
                    </div>
                    <!-- Email -->
                    <label>Email: </label>
                    <div class="input-group mb-3 py-1">
                        <input type="email" name="email" id="email" class="form-control" autocomplete="off" required="required">
                    </div>
                    <!-- Number -->
                    <label>Phone Number: </label>
                    <div class="input-group mb-3 py-1">
                        <input type="text" name="number" id="number" class="form-control" autocomplete="off" minlength="10" maxlength="10" required="required">
                    </div>
                    <!-- Address -->
                    <label>Address: </label>
                    <div class="input-group mb-3 py-1">
                        <textarea name="address" id="address" class="form-control" aria-label="With textarea" autocomplete="off" required="required"></textarea>
                    </div>
                    <!-- Department -->
                    <label>Department: </label>
                    <div class="input-group mb-3 py-1">
                        <input type="text" name="department" id="department" class="form-control" autocomplete="off" required="required">
                    </div>
                    <!-- Designation -->
                    <label>Designation: </label>
                    <div class="input-group mb-3 py-1">
                        <input type="text" name="designation" id="designation" class="form-control" autocomplete="off" required="required">
                    </div>
                    <!-- Photo -->
                    <label>Photo: </label>
                    <div class="input-group mb-3 py-1">
                        <!-- <label class="custom-file-label" for="userphoto">Choose file</label>
                        <input type="file" class="custom-file-input" name="photo" id="userphoto"> -->

                        <label class="input-group-text" for="userphoto"><i class="fa-solid fa-cloud-arrow-up"></i></label>
                        <input type="file" class="form-control" name="photo" id="photo">
                    </div>
                </div>
            

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Submit</button>

            <!-- 2 input fields, first for adding and second for update,delete or view profile -->
            <input type="hidden" name="action" value="adduser">
            <input type="hidden" name="userid" id="userid" value="">
            </div>
        </form>
    </div>
    </div>
</div> 