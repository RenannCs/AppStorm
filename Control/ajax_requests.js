function requestUserDataAjax(id) {
    
    return new Promise(function(resolve, reject) {
        $.post("../Control/get_funcionario.php", { id: id })
            .done(function (data) {
                resolve(data);
            })
            .fail(function () {
                reject('Falha ao obter os dados do funcionário');
            });
    });
}

function requestUsersDataAjax() {
    
    return new Promise(function(resolve, reject) {
        $.post("../Control/get_funcionarios.php")
            .done(function (data) {
                resolve(data);
            })
            .fail(function () {
                reject('Falha ao obter os dados do funcionário');
            });
    });
}
