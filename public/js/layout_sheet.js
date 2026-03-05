        document.addEventListener('click', function(e){
            const btnImage = e.target.closest('[data-bs-target="#modalImage"]')
            if(!btnImage) return;
            document.getElementById('images').src = btnImage.dataset.image
        })
        const table = new TablePlus({
            url : getLs,
            columns : {
                noLane: 'No Lane',
                image_url : {
                    label : 'Image',
                    render: (row) => {
                        return `
                        <button
                            class="btn btn-sm btn-teal"
                            data-bs-toggle="modal"
                            data-bs-target="#modalImage"
                            data-image='${row.image_url}'>
                            View Image
                        </button>
                        `
                    },
                    exportText: (row) => {
                        return row.image
                    }
                }
            },
            perPage: 10,
            perPageOptions: [10,20,50,100],
            rowIdentifier: 'lId',
            savePreferences: true,
            customActions: [
                {
                    label: 'Update',
                    className: 'bg-yellow-400 text-white px-3 py-1 rounded text-sm',
                    onClick: (selectedIds) => {
                                    
                        if (selectedIds.length === 0) {
                            Swal.fire('Pilih 1 data untuk edit');
                            return;
                        }

                        if (selectedIds.length > 1) {
                            Swal.fire('Edit hanya bisa 1 data');
                            return;
                        }

                        const selectedData = table.rows({ selected: true }).data()[0];

                        $('#unoLane').val(selectedData.laneId);
                        $('#unoMcLane').val(selectedData.noMcLane);

                        $('#modalEdit').modal('show');
                    }
                },
                {
                    label: 'Delete',
                    className: 'bg-red-600 text-white px-3 py-1 rounded text-sm',
                    onClick: (selectedIds) => {
                        if (selectedIds.length === 0) {
                            Swal.fire('Pilih data yang ingin dihapus');
                            return;
                        }
                        const selectedData = table.rows({ selected: true }).data()[0];
                        Swal.fire({
                            title: 'Delete',
                            icon: 'warning',
                            text: `Yakin ingin dihapus ${selectedData.lId}?`,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Hapus!!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: 'DELETE',
                                    url: deleteLs +'/'+ selectedData.lId,
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    success: function(response) {
                                        if (response.status === 200) {
                                            Swal.fire({
                                                title: 'Success',
                                                icon: 'success',
                                                text: response.message,
                                                timer: 1500,
                                                timerProgressBar: true,
                                            });
                                            table.refresh();
                                        } else {
                                            Swal.fire({
                                                title: 'Error',
                                                icon: 'error',
                                                text: 'Data Error',
                                                timer: 1500,
                                                timerProgressBar: true,
                                            });
                                        }
                                    }, error: function(err,res,message){
                                        var errmes = ''
                                        if(err.responseJSON.status === 422 && typeof err.responseJSON.message === 'object'){
                                            for(var field in err.responseJSON.message){
                                                if(err.responseJSON.message.hasOwnProperty(field)){
                                                    err.responseJSON.message[field].forEach(function(message){
                                                        errmes += message + '\n'
                                                    })
                                                }
                                            }
                                        } else {
                                            errmes = err.responseJSON.message
                                        }
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: errmes.trim()
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            ],
        })
        table.render('#lsTable')
$(document).ready(function(){
    crud()
})

function crud()
{
    $('#addls').on('click', function(e){
        e.preventDefault()
        var form = new FormData($('#formaddls')[0])
        const btnAdd = $('#addls')
        const btnLoading = $('#loading')
        btnAdd.hide()
        btnLoading.show()
        $.ajax({
            url : createLs,
            type: 'POST',
            data : form,
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status === 200){
                    btnAdd.show()
                    btnLoading.hide()
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    }).then((result) => {
                        table.refresh()
                    })
                } else {
                    btnAdd.show()
                    btnLoading.hide()
                    var errmes = ''
                    if(response.status === 422 && typeof response.message === 'object'){
                        for(var field in response.message){
                            if(response.message.hasOwnProperty(field)){
                                response.message[field].forEach(function(message){
                                    errmes += message + '\n'
                                })
                            }
                        }
                    } else {
                        errmes = 'An unexcpected error occured.'
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errmes.trim()
                    })
                }
            }, error: function(err,res,message){
                btnAdd.show()
                btnLoading.hide()
                var errmes = ''
                if(err.responseJSON.status === 422 && typeof err.responseJSON.message === 'object'){
                    for(var field in err.responseJSON.message){
                        if(err.responseJSON.message.hasOwnProperty(field)){
                            err.responseJSON.message[field].forEach(function(message){
                                errmes += message + '\n'
                            })
                        }
                    }
                } else {
                    errmes = err.responseJSON.message
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errmes.trim()
                })
            }
        })
    })
    $('#editls').on('click', function(e){
        e.preventDefault()
        var selected = table.rows({selected: true}).ids()
        var form = new FormData($('#formeditls')[0])
        const btnAdd = $('#editls')
        const btnLoading = $('#loadingedit')
        btnAdd.hide()
        btnLoading.show()
        $.ajax({
            url : editLs +'/'+ selected,
            type: 'POST',
            data : form,
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status === 200){
                    btnAdd.show()
                    btnLoading.hide()
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    }).then((result) => {
                        table.refresh()
                    })
                } else {
                    btnAdd.show()
                    btnLoading.hide()
                    var errmes = ''
                    if(response.status === 422 && typeof response.message === 'object'){
                        for(var field in response.message){
                            if(response.message.hasOwnProperty(field)){
                                response.message[field].forEach(function(message){
                                    errmes += message + '\n'
                                })
                            }
                        }
                    } else {
                        errmes = 'An unexcpected error occured.'
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errmes.trim()
                    })
                }
            }, error: function(err,res,message){
                btnAdd.show()
                btnLoading.hide()
                var errmes = ''
                if(err.responseJSON.status === 422 && typeof err.responseJSON.message === 'object'){
                    for(var field in err.responseJSON.message){
                        if(err.responseJSON.message.hasOwnProperty(field)){
                            err.responseJSON.message[field].forEach(function(message){
                                errmes += message + '\n'
                            })
                        }
                    }
                } else {
                    errmes = err.responseJSON.message
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errmes.trim()
                })
            }
        })
    })
}