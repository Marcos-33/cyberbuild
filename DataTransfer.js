function login() {
  const dniInput = document.getElementsByName("dni")[0];
  const passwordInput = document.getElementsByName("contrasena")[0];
  const msg = document.getElementById("msg");

  const dni = dniInput?.value?.trim() || "";
  const password = passwordInput?.value?.trim() || "";

  const dropArea = document.getElementById("drop-area")
  const fileInput = document.getElementsById("fileInput");

  // Validar entrada
  if (!dni || !password) {
    msg.textContent = "Por favor completa todos los campos";
    msg.style.color = "orange";
    return;
  }

  // IMPORTANTE: Las credenciales NO deben estar en el cliente 
  // Enviar estos datos al servidor para validación
  fetch("/api/login", { 
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ dni, password })
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        msg.textContent = "Sesión iniciada";
        msg.style.color = "green";
        // Redirigir o guardar token
      } else {
        msg.textContent = "Credenciales inválidas";
        msg.style.color = "red";
      }
    })
    .catch(error => {
      console.error("Error:", error);
      msg.textContent = "Error en la conexión";
      msg.style.color = "red";
    });
}

    //Click abre el selector
    dropArea.addEventListener("click", () => {
      fileInput.click();
    });

    //Arrastrar encima
    dropArea.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropArea.classList.remove("hover");
    });

    // Salir
    dropArea.addEventListener("dragleave", () => {
      dropArea.classList.remove("hover");
    });

    // Soltar archivo
    dropArea.addEventListener(drop, (e) => {
      e.preventDefault();
      fileInput.files = e.dataTransfer.files;
      dropArea.classList.remove("hover");
    });