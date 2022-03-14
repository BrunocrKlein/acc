$(document).ready(function () {
  $("#form-login").submit(function (event) {
    event.stopPropagation();
    inserir_usuario();
    return false;
  });

  function inserir_usuario() {

    var formData = new FormData();
    formData.append('login_matricula', $("#login_matricula").val());
    formData.append('login_nome', $("#login_nome").val());
    formData.append('login_email', $("#login_email").val());
    formData.append('login_password', $("#login_password").val());

    $.ajax({
      url: './CadastrarLogin/cadastrarUsuario',
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      type: 'POST',
      sucess: function (result) { }
    }).done(function (msg) {
     
      if (msg.matricula == 'inexistente') {
        bootbox.alert("Usuário cadastrado com sucesso!", function () {
          window.location.href = "#";
        });
      } else {
        alert("Erro ao criar usuário!");
        location.reload();
      }

    });
  }

/*
  const btnLogin = document.querySelector(".btn-login");
  const form = document.querySelector("form");

  btnLogin.addEventListener("click", event => {
    event.preventDefault();

    const fields = [...document.querySelectorAll(".input-block input")];

    fields.forEach(field => {
      if (field.value === "") form.classList.add("validate-error");
    });

    const formError = document.querySelector(".validate-error");
    if (formError) {
      formError.addEventListener("animationend", event => {
        if (event.animationName === "nono") {
          formError.classList.remove("validate-error");
        }
      });
    } else {
      form.classList.add("form-hide");
    }
  });

  form.addEventListener("animationstart", event => {
    if (event.animationName === "down") {
      document.querySelector("body").style.overflow = "hidden";
    }
  });

  form.addEventListener("animationend", event => {
    if (event.animationName === "down") {
      form.style.display = "none";
      document.querySelector("body").style.overflow = "none";
    }
  });*/

  /* background squares */
  const ulSquares = document.querySelector("ul.squares");

  for (let i = 0; i < 11; i++) {
    const li = document.createElement("li");

    const random = (min, max) => Math.random() * (max - min) + min;

    const size = Math.floor(random(10, 120));
    const position = random(1, 99);
    const delay = random(5, 0.1);
    const duration = random(24, 12);

    li.style.width = `${size}px`;
    li.style.height = `${size}px`;
    li.style.bottom = `-${size}px`;

    li.style.left = `${position}%`;

    li.style.animationDelay = `0.0`;
    li.style.animationDuration = `${duration}s`;
    li.style.animationTimingFunction = `cubic-bezier(${Math.random()}, ${Math.random()}, ${Math.random()}, ${Math.random()})`;

    ulSquares.appendChild(li);
  }

});
