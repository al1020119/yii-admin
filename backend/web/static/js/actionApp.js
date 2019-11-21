var actionApp = {
    changeStatus: function (a) {
        swal({
            title: "确定切换吗?",
            text: "此操作可复原!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "确定切换",
            cancelButtonText: "取消",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                type: 'get',
                url: a.href,
                dataType: 'json',
                success: function (data) {
                    if (data.state) {
                        $.pjax.reload('#item-data-list');
                        swal("已切换", data.message, "success");
                    } else {
                        swal("异常", data.message, "error");
                    }
                },
                error: function (err) {
                    console.log(err);
                    throw err;
                }
            });
        });
    },
    deleteDatas: function (a) {
        swal({
            title: "确定删除吗?",
            text: "此操作不可复原!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "确定删除",
            cancelButtonText: "取消",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                type: 'delete',
                url: a.href,
                dataType: 'json',
                success: function (data) {
                    if (data.state) {
                        $.pjax.reload('#item-data-list');
                        swal("已删除", data.message, "success");
                    } else {
                        swal("异常", data.message, "error");
                    }
                },
                error: function (err) {
                    console.log(err);
                    throw err;
                }
            });
        });
    },
}



