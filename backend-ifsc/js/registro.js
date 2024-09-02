
const btnRegistro = document.getElementById("btnRegistro");
btnRegistro.addEventListener("click", (e) => {
    console.log("btnRegistro");
    e.preventDefault()

    const frmRegistro = document.getElementById("frmRegistro");
    let data = new FormData(frmRegistro);
    for (const key of data.keys()) {
        console.log(key, data.get(key));
    }
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            let msg = JSON.parse(xhr.responseText);
            const footer = document.querySelector("footer");
            if (msg.code == 200) {
                footer.innerHTML = msg.text + "<br><a href='index.php'>Voltar para a tela de login</a>";
                frmRegistro.reset()
            }
            else {
                footer.innerText = xhr.responseText;
            }
        }
    }
    xhr.open("POST", "registro-controller.php");
    xhr.send(data);
})


