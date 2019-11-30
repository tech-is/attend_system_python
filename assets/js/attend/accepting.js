$(function () {
    $('#form').on('submit', function (e) {
        e.preventDefault();
        let form = $('#form').serializeArray();
        let param = {};
        for (let i = 0; i < form.length; i++) {
            param[form[i]['name']] = form[i]['value'];
        }
        let type = 'POST';
        let url = 'attend/judge_attendance';
        xhr_connect(type, url, param);
    });
});