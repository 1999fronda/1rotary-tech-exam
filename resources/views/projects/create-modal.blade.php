<div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createProjectModalLabel">Create project</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('projects.store') }}" id="createProjectForm">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="name" class="form-control" id="name" name="name" maxlength="255" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span
                                class="text-muted fst-italic">(optional)</span></label>
                        <div class="form-floating">
                            <textarea class="form-control" name="description" id="description" style="height: 100px"></textarea>
                        </div>
                    </div>
                    <div>
                        <button type="submit" id="createSubmitButton" class="btn btn-dark">
                            <span class="spinner-border spinner-border-sm" style="display: none"
                                aria-hidden="true"></span>
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
