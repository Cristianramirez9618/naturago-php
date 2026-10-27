
document.addEventListener("DOMContentLoaded", function () {
    const botonAbrir = document.getElementById("abrirAsistente");
    const botonCerrar = document.getElementById("cerrarAsistente");
    const ventana = document.getElementById("ventanaAsistente");
    const mensajes = document.getElementById("mensajesAsistente");
    const formulario = document.getElementById("formAsistente");
    const campoPregunta = document.getElementById("preguntaAsistente");
    const botonEnviar = document.getElementById("enviarAsistente");

    // Dirección de la API local de Python.
    // En producción habrá que cambiarla por la dirección pública de la API.
    const API_CHAT = "http://127.0.0.1:8000/chat";

    function abrirChat() {
        ventana.hidden = false;
        botonAbrir.setAttribute("aria-expanded", "true");
        campoPregunta.focus();
    }

    function cerrarChat() {
        ventana.hidden = true;
        botonAbrir.setAttribute("aria-expanded", "false");
        botonAbrir.focus();
    }

    botonAbrir.addEventListener("click", function () {
        if (ventana.hidden) {
            abrirChat();
        } else {
            cerrarChat();
        }
    });

    botonCerrar.addEventListener("click", cerrarChat);

    function agregarMensaje(texto, tipo) {
        const mensaje = document.createElement("p");

        // textContent evita interpretar la respuesta como código HTML.
        mensaje.textContent = texto;
        mensaje.classList.add("mensaje-chat", tipo);

        mensajes.appendChild(mensaje);
        mensajes.scrollTop = mensajes.scrollHeight;

        return mensaje;
    }

    formulario.addEventListener("submit", async function (evento) {
        evento.preventDefault();

        const pregunta = campoPregunta.value.trim();

        if (!pregunta) {
            return;
        }

        agregarMensaje(pregunta, "mensaje-usuario");

        campoPregunta.value = "";
        campoPregunta.disabled = true;
        botonEnviar.disabled = true;

        const mensajeEspera = agregarMensaje(
            "Estoy buscando una recomendación...",
            "mensaje-bot"
        );

        try {
            const respuesta = await fetch(API_CHAT, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    mensaje: pregunta
                })
            });

            const datos = await respuesta.json();

            if (!respuesta.ok || datos.success !== true) {
                throw new Error("La API no pudo procesar la pregunta.");
            }

            mensajeEspera.textContent = datos.respuesta;

        } catch (error) {
            console.error("Error del asistente:", error);

            mensajeEspera.textContent =
                "No pude conectarme con el asistente. " +
                "Verifica que el servidor de Python esté ejecutándose " +
                "en el puerto 8000 e inténtalo nuevamente.";
        } finally {
            campoPregunta.disabled = false;
            botonEnviar.disabled = false;
            campoPregunta.focus();
            mensajes.scrollTop = mensajes.scrollHeight;
        }
    });
});
