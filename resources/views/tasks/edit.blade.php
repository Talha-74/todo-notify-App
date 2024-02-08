{{-- Edit task --}}
<div class="modal fade" id="editTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Task</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tasks.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="task_id" id="id">
                    <div class="form-group mb-3" style="position: relative;">
                        <label class="control-label mb-2" for="title">Title<code>*</code></label>
                        <input type="text" class="form-control rounded-2" name="title" id="taskTitle"
                            placeholder="task title" required>
                    </div>
                    <div class="form-group mt-2">
                        <label class="control-label mb-1" for="description">Description<code>*</code></label>
                        <textarea type="text" class="form-control rounded-2" name="description" id="description_id"
                            placeholder="Task Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="assign_to">Assign To</label>
                        <select class="form-control" id="assign_to_id" name="assigned_to" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="statusId" name="status" required>
                            <option value="0">Pending</option>
                            <option value="1">Completed</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="reset" class="btn btn-warning">
                <button class="btn btn-success">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".update_task", function () {
        var taskId = $(this).data("id");
        var taskTitle = $(this).data("title");
        var taskDescription = $(this).data("description");
        var taskAssignedTo = $(this).data("assigned_to");
        var taskStatus = $(this).data("status");

        // Set values to input fields in the edit modal
        $("#id").val(taskId);
        $("#taskTitle").val(taskTitle);
        $("#description_id").val(taskDescription);
        // Set value for Assign To dropdown
      // Set value for Assign To dropdown
        if (taskAssignedTo !== null && taskAssignedTo !== undefined) {
        $("#assign_to_id").val(taskAssignedTo);
        } else {
        // If taskAssignedTo is null or undefined, set the dropdown to a default value
        $("#assign_to_id").val("null");
        }

        // Set value for Status dropdown
        if (taskStatus !== null && taskStatus !== undefined) {
        $("#statusId").val(taskStatus);
        } else {
        // If taskStatus is null or undefined, set the dropdown to a default value
        $("#statusId").val("Pending");
        }
    });
</script>
