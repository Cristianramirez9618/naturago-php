
document.addEventListener("DOMContentLoaded", () => {
    const modalLogin = document.getElementById("modalLogin");
    const modalRegistro = document.getElementById("modalRegistro");
    const formLogin = document.getElementById("formLogin");
    const formRegistro = document.getElementById("formRegistro");
    const mensajeLogin = document.getElementById("mensajeLogin");
    const mensajeRegistro = document.getElementById("mensajeRegistro");

    function mostrarModal(modal) {
        if (modal) modal.hidden = false;
    }

    function cerrarModal(modal) {
        if (modal) modal.hidden = true;
    }

    function ponerMensaje(elemento, texto, tipo = "") {
        if (!elemento) return;
        elemento.textContent = texto;
        elemento.className = "mensaje-formulario" + (tipo ? " " + tipo : "");
    }

    document.getElementById("botonLogin")?.addEventListener("click", () => {
        mostrarModal(modalLogin);
    });

    document.getElementById("botonRegistro")?.addEventListener("click", () => {
        mostrarModal(modalRegistro);
    });

    document.getElementById("irRegistro")?.addEventListener("click", () => {
        cerrarModal(modalLogin);
        mostrarModal(modalRegistro);
    });

    document.getElementById("irLogin")?.addEventListener("click", () => {
        cerrarModal(modalRegistro);
        mostrarModal(modalLogin);
    });

    document.querySelectorAll("[data-cerrar-modal]").forEach((boton) => {
        boton.addEventListener("click", () => {
            cerrarModal(document.getElementById(boton.dataset.cerrarModal));
        });
    });

    [modalLogin, modalRegistro].forEach((modal) => {
        modal?.addEventListener("click", (evento) => {
            if (evento.target === modal) cerrarModal(modal);
        });
    });

    document.addEventListener("keydown", (evento) => {
        if (evento.key === "Escape") {
            cerrarModal(modalLogin);
            cerrarModal(modalRegistro);
        }
    });

    // Manejo de la sesión en el navegador
    const usuarioActivo = document.getElementById("usuarioActivo");
    const botonLogin = document.getElementById("botonLogin");
    const botonRegistro = document.getElementById("botonRegistro");
    const botonCerrarSesion = document.getElementById("botonCerrarSesion");

    function actualizarSesion(usuario) {
        if (usuario) {
            usuarioActivo.textContent = "Hola, " + usuario.nombre;
            usuarioActivo.hidden = false;
            botonLogin.hidden = true;
            botonRegistro.hidden = true;
            botonCerrarSesion.hidden = false;
        } else {
            usuarioActivo.textContent = "";
            usuarioActivo.hidden = true;
            botonLogin.hidden = false;
            botonRegistro.hidden = false;
            botonCerrarSesion.hidden = true;
        }
    }

    try {
        actualizarSesion(
            JSON.parse(localStorage.getItem("naturago_usuario") || "null")
        );
    } catch (error) {
        localStorage.removeItem("naturago_usuario");
        actualizarSesion(null);
    }

    botonCerrarSesion?.addEventListener("click", () => {
        localStorage.removeItem("naturago_usuario");
        actualizarSesion(null);
    });

    // Registro de usuarios mediante la API PHP
    formRegistro?.addEventListener("submit", async (evento) => {
        evento.preventDefault();
        ponerMensaje(mensajeRegistro, "Creando tu cuenta...");

        const datos = {
            nombre: document.getElementById("registroNombre").value.trim(),
            correo: document.getElementById("registroCorreo").value.trim(),
            password: document.getElementById("registroPassword").value
        };

        try {
            const respuesta = await fetch("api/registro.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(datos)
            });

            const resultado = await respuesta.json();

            if (!respuesta.ok || !resultado.success) {
                throw new Error(
                    resultado.mensaje || "No se pudo crear la cuenta."
                );
            }

            ponerMensaje(
                mensajeRegistro,
                resultado.mensaje || "Registro exitoso. Ya puedes iniciar sesión.",
                "exito"
            );

            formRegistro.reset();
        } catch (error) {
            ponerMensaje(
                mensajeRegistro,
                error.message || "No fue posible conectar con el servidor.",
                "error"
            );
        }
    });

    // Inicio de sesión mediante la API PHP
    formLogin?.addEventListener("submit", async (evento) => {
        evento.preventDefault();
        ponerMensaje(mensajeLogin, "Verificando tus datos...");

        const datos = {
            correo: document.getElementById("loginCorreo").value.trim(),
            password: document.getElementById("loginPassword").value
        };

        try {
            const respuesta = await fetch("api/login.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(datos)
            });

            const resultado = await respuesta.json();

            if (!respuesta.ok || !resultado.success) {
                throw new Error(
                    resultado.mensaje || "Correo o contraseña incorrectos."
                );
            }

            const usuario = resultado.usuario || {
                nombre: resultado.nombre || datos.correo,
                correo: datos.correo
            };

            const sesion = {
                nombre: usuario.nombre || datos.correo,
                correo: usuario.correo || datos.correo
            };

            localStorage.setItem("naturago_usuario", JSON.stringify(sesion));
            actualizarSesion(sesion);

            ponerMensaje(
                mensajeLogin,
                resultado.mensaje || "Inicio de sesión correcto.",
                "exito"
            );

            formLogin.reset();
            setTimeout(() => cerrarModal(modalLogin), 700);
        } catch (error) {
            ponerMensaje(
                mensajeLogin,
                error.message || "No fue posible conectar con el servidor.",
                "error"
            );
        }
    });

    // Chatbot turístico conectado a FastAPI
    const abrirChat = document.getElementById("abrirChat");
    const cerrarChat = document.getElementById("cerrarChat");
    const ventanaChat = document.getElementById("ventanaChat");
    const formularioChat = document.getElementById("formChat");
    const entradaChat = document.getElementById("entradaChat");
    const mensajesChat = document.getElementById("mensajesChat");

    abrirChat?.addEventListener("click", () => {
        ventanaChat.hidden = false;
        entradaChat?.focus();
    });

    cerrarChat?.addEventListener("click", () => {
        ventanaChat.hidden = true;
    });

    function agregarMensaje(texto, clase) {
        const elemento = document.createElement("p");
        elemento.className = clase;
        elemento.textContent = texto;
        mensajesChat.appendChild(elemento);
        mensajesChat.scrollTop = mensajesChat.scrollHeight;
        return elemento;
    }

    formularioChat?.addEventListener("submit", async (evento) => {
        evento.preventDefault();

        const texto = entradaChat.value.trim();
        if (!texto) return;

        agregarMensaje(texto, "mensaje-usuario");
        entradaChat.value = "";

        const cargando = agregarMensaje("Escribiendo...", "mensaje-bot");

        try {
            const respuesta = await fetch("http://127.0.0.1:8000/chat", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ mensaje: texto })
            });

            if (!respuesta.ok) {
                throw new Error("Respuesta HTTP " + respuesta.status);
            }

            const datos = await respuesta.json();
            cargando.textContent =
                datos.respuesta || "No recibí una respuesta.";
        } catch (error) {
            cargando.textContent =
                "No puedo conectar con la API de Python. " +
                "Verifica que Uvicorn esté ejecutándose en el puerto 8000.";

            console.error("Error del chatbot NATURAGO:", error);
        }

        mensajesChat.scrollTop = mensajesChat.scrollHeight;
    });
});
