function myFunction(newid) {
    var x = document.getElementById(newid);
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  