        document.addEventListener('click', function(e){
            const btnImage = e.target.closest('[data-bs-target="#modalImage"]')
            if(!btnImage) return;
            document.getElementById('images').src = btnImage.dataset.image
        })
        const table = new TablePlus({
            url : getPs,
            columns : {
                noLane: 'No Lane',
                empNik : 'Employee NIK',
                empName : 'Employee Name',
                profil : {
                    label : 'Image',
                    render: (row) => {
                        return `
                        <button
                            class="btn btn-sm btn-teal"
                            data-bs-toggle="modal"
                            data-bs-target="#modalImage"
                            data-image='${row.profil_url}'>
                            View Image
                        </button>
                        `
                    },
                    exportText: (row) => {
                        return row.profil
                    }
                },
                pointSkill : 'Point Skill',
                pointSkill2 : 'Point Skill 2',
            },
            perPage: 10,
            perPageOptions: [10,20,50,100],
            rowIdentifier: 'psId',
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
                        console.log(selectedData)
                        $('#unoLane').val(selectedData.laneId);
                        $('#unoMcLane').val(selectedData.noMcLane);
                        $('#uempNik').val(selectedData.empNik);
                        $('#uempName').val(selectedData.empName);
                        $('#upointSkill').val(selectedData.pointSkill);
                        $('#upointSkill2').val(selectedData.pointSkill2);

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
                            text: `Yakin ingin dihapus ${selectedData.empName}?`,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Hapus!!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: 'DELETE',
                                    url: deletePs +'/'+ selectedData.psId,
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
        table.render('#psTable')
$(document).ready(function(){
    crud()
    $('#empNik').on('change', function(e){
        e.preventDefault()
        $.ajax({
            url : urlEmp,
            type: 'POST',
            data : {
                nik : $(this).val()
            },
            headers : {
                'X-CSRF-TOKEN' : csrfToken
            },
            success: function(response){
                if(response.status === 200) {
                    $('#empName').val(response.data.nama)
                    $('#previewPhoto').attr('src', response.data.photo_url)
                    $('#photo_url').val(response.data.photo_url)
                }
            }
        })
    })
})

function crud()
{
    $('#addps').on('click', function(e){
        e.preventDefault()
        var form = new FormData($('#formaddps')[0])
        const btnAdd = $('#addps')
        const btnLoading = $('#loading')
        btnAdd.hide()
        btnLoading.show()
        $.ajax({
            url : createPs,
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
    $('#editps').on('click', function(e){
        e.preventDefault()
        var selected = table.rows({selected: true}).ids()
        var form = new FormData($('#formeditps')[0])
        const btnAdd = $('#editps')
        const btnLoading = $('#loadingedit')
        btnAdd.hide()
        btnLoading.show()
        $.ajax({
            url : editPs +'/'+ selected,
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