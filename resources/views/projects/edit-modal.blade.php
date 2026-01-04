<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editProjectModalLabel">Edit project</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateProjectForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editProjectId" name="editProjectId">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="name" class="form-control" id="editName" name="editName" maxlength="255"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description <span
                                class="text-muted fst-italic">(optional)</span></label>
                        <div class="form-floating">
                            <textarea class="form-control" name="editDescription" id="editDescription" style="height: 100px"></textarea>
                        </div>
                    </div>
                    <div>
                        <button type="submit" id="updateSubmitButton" class="btn btn-dark">
                            <span class="spinner-border spinner-border-sm" style="display: none"
                                aria-hidden="true"></span>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
