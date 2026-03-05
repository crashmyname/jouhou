        // document.addEventListener('click', function (e) {
        //     const btn = e.target.closest('[data-bs-target="#modalEdit"]');
        //     if (!btn) return;

        //     const lane = JSON.parse(btn.dataset.lane);

        //     document.getElementById('uusername').value = user.username ?? '';
        //     document.getElementById('uname').value = user.name ?? '';
        // });
        const table = new TablePlus({
            url : getLane,
            columns : {
                noLane : 'No Lane',
                description : 'Description',
            },
            perPage: 10,
            perPageOptions: [10,20,50,100],
            rowIdentifier: 'laneId',
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

                        $('#unoLane').val(selectedData.noLane);
                        $('#udescription').val(selectedData.description);

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
                            text: `Yakin ingin dihapus ${selectedData.noLane}?`,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Hapus!!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: 'DELETE',
                                    url: deleteLane +'/'+ selectedData.laneId,
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
        table.render('#laneTable')
$(document).ready(function(){
    crud()
})

function crud()
{
    $('#addlane').on('click', function(e){
        e.preventDefault()
        var form = new FormData($('#formaddlane')[0])
        const btnAdd = $('#addlane')
        const btnLoading = $('#loading')
        btnAdd.hide()
        btnLoading.show()
        $.ajax({
            url : createLane,
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
    $('#editlane').on('click', function(e){
        e.preventDefault()
        var selected = table.rows({selected: true}).ids()
        var form = new FormData($('#formeditlane')[0])
        const btnAdd = $('#editlane')
        const btnLoading = $('#loadingedit')
        btnAdd.hide()
        btnLoading.show()
        $.ajax({
            url : editLane +'/'+ selected,
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