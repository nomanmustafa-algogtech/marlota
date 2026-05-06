$(document).ready(function () {

    // Initialize Quill editor
    var quill = new Quill('#page-editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link'],
                ['clean']
            ]
        }
    });

    // Load existing content (edit mode)
    var existingContent = $('#content').val();
    if (existingContent && existingContent.trim() !== '') {
        quill.root.innerHTML = existingContent;
    }

    // Auto-generate slug from name (add form only)
    var slugManual = false;
    $('#name').on('input', function () {
        if (slugManual) return;
        $('#slug').val(
            $(this).val()
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
        );
    });
    $('#slug').on('input', function () {
        slugManual = true;
    });

    // On submit, write Quill HTML into the hidden input
    $('#page-form').on('submit', function () {
        $('#content').val(quill.root.innerHTML);
    });

});
