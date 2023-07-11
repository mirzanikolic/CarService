var LoginService = {
  init: function(){
    var token = localStorage.getItem("token");
    if (token){
      window.location.replace("home.html");
    }
    $('#login-form').validate({
      submitHandler: function(form) {
        var entity = Object.fromEntries((new FormData(form)).entries());
        console.log(entity);
        LoginService.login(entity);
      }
    });
  },
  login: function(entity){
    $.ajax({
      url: 'rest/staging/login',
      type: 'POST',
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function(result) {
        console.log(result);
        localStorage.setItem("token", result.token);
        window.location.replace("home.html");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
      }
    });
  },

  logout: function(){
    localStorage.clear();
    window.location.replace("login.html");
  },
}