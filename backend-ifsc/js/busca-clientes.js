const btnBusca = document.getElementById("btnBusca");
const btnIncluirCliente = document.getElementById("btnIncluirCliente");
const btnIncluir = document.getElementById("btnIncluir");
const btnAtualizar = document.getElementById("btnAtualizar");
const content = document.getElementById("content");
const frmIncluirCliente = document.getElementById("frmIncluirCliente");
const frmBuscarCliente = document.getElementById("frmBuscarCliente");

btnIncluirCliente.addEventListener("click", (e) => {
  var elemSelectUF = document.getElementById("id_uf");
  var xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status == 200 && xhr.readyState == 4) {
      console.log(xhr.responseText);
      var arrayUf = JSON.parse(xhr.responseText);
      for (uf of arrayUf) {
        console.log(uf);
        let elemOption = document.createElement("option");
        elemOption.innerText = `${uf.sigla} - ${uf.nome}`;
        elemOption.setAttribute("value",uf.id_uf);
        elemSelectUF.appendChild(elemOption);
      }
    }
  };
  xhr.open("GET", "uf-controller.php");
  xhr.send();
  bootstrap.Modal.getInstance(document.getElementById("modalIncluirCliente")).show();
});

btnIncluir.addEventListener("click", (e) => {
  e.preventDefault();
  const xhr = new XMLHttpRequest();
  const frmIncluirCliente = document.getElementById("frmIncluirCliente");
  let cliente = new FormData(frmIncluirCliente);
  for (let[key,val] of cliente) {
    console.log(key + "=" + val);
  }
  xhr.onload = function ()  {
    if (xhr.status == 200) {
      console.log(xhr.responseText);
      frmIncluirCliente.reset();
      bootstrap.Modal.getInstance(document.getElementById("modalIncluircliente")). hide();
      buscaClientes();
    } else {
      alert("Erro inclusão");
    }
  };
  xhr.open("POST", "insert-cliente.php");
  xhr.send(cliente);
});

btnBusca.addEventListener("click", buscaClientes);
document.addEventListener("DOMContentLoaded", buscaClientes);
frmBuscarCliente.addEventListener("submit", buscaClientes);

function buscaClientes(e) {
   if (e) e.preventDefault();

  const expressaoBusca = document.getElementById("expressaoBusca").value;
  console.log(expressaoBusca);

  const req = new XMLHttpRequest();
  req.onload = function () {
    if (req.status == 200) {
      console.log(this.responseText);
       const vetorClientes = JSON.parse(this.responseText);

      let html = "<table class='table table-bordered table-hover table-sm'>";
      html +=
        "<tr><th>Cod</th><th>Nome</th><th>Email</th><th>UF</th><th>Alterações</th></tr>";
      // buscar registros de clientes
      for (let cliente of vetorClientes) {
        html += "<tr>";
        html += `<td>${cliente.codigo}</td>`;
        html += `<td>${cliente.nome}</td>`;
        html += `<td>${cliente.email}</td>`;
        html += `<td>${cliente.sigla}</td>`;
        html += `<td class="d-flex justify-content-center gap-4">`;
        html += `<button class='btn btn-warning' data-bs-toggle="modal" data-bs-target="#modalEditar" onClick="showClientUpForm(${cliente.codigo})"> <i class='fa-solid fa-pencil'></i> Editar</button>`;
        html += `<button class='btn btn-danger' ms-3 onClick="delCliente(${cliente.codigo})"> <i class='fa-solid fa-trash-can'></i> Deletar</button>`;
        html += `</td>`;
        html += "</tr>";
      }
      html += "</table>";
      content.innerHTML = html;
    } else {
      alert(`Erro: ${req.status} ${req.statusText}`);
    }
  };
  req.open("GET", `busca-clientes.php?expressaoBusca=${encodeURIComponent(expressaoBusca)}`);
  req.send();
}

function showClientUpForm(codigo) {
  let xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      // console.log(xhr.responseText);
      cliente = JSON.parse(xhr.responseText)[0];
      console.log(cliente);
      const frm = document.getElementById("frmAlterarCliente");
      frm.codigo.value = cliente.codigo;
      frm.nome.value = cliente.nome;
      frm.email.value = cliente.email;
    }
  };

  xhr.open("GET", `cliente-get.php?codigo=${codigo}`);
  xhr.send();
}

btnAtualizar.addEventListener("click", (e) => {
  const frm = document.getElementById("frmAlterarCliente");
  let cliente = new FormData(frm);

  let xhr = new XMLHttpRequest();
  xhr.onload = function () {
     console.log(xhr.responseText);
    if (xhr.status === 200) {
      buscaClientes();
      bootstrap.Modal.getInstance(
        document.getElementById("modalEditar")
      ).hide();
    }
  };

  xhr.open("POST", "cliente-update.php");
  xhr.send(cliente);
});

function delCliente(id) {
  const ret = confirm("Confirma a exclusão do registro?");

  if (ret == true) {
    const data = new FormData();
    data.append("id", id);

    console.log(data);

    const req = new XMLHttpRequest();
    req.onload = function () {
      if (req.status == 200) {
        alert("Exclusão OK");
        buscaClientes();
      } else {
        alert(`Erro: ${req.status} ${req.statusText}`);
      }
    };
    req.open("POST", "delete-cliente.php");
    req.send(data);
  }
}
