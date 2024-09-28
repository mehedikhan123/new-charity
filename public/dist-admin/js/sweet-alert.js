// public/js/sweet-alert.js

function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove the data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Only submit the form if the user confirms
            document.getElementById('delete-form-' + id).submit();
        }
    });
}

function confirmChangeStatus(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to change the status!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Only submit the form if the user confirms
            document.getElementById('change-status-form-' + id).submit();
        }
    });
}