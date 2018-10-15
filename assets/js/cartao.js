function listarSetor(unidade){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200) {
	    document.getElementById("setores").innerHTML = this.responseText;
	}

    };
    xhttp.open("GET", "listar_setor/"+unidade, true);
    xhttp.send();
}

function listarEndereco(unidade){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200) {
	    document.getElementById("enderecos").innerHTML = this.responseText;
	}

    };
    xhttp.open("GET", "listar_endereco/"+unidade, true);
    xhttp.send();
}

function verificarSobrenome(nome){
    var res = nome.split(" ");
    if(res.length < 2){
	document.getElementById("error_nome").style.display = 'block';
	document.getElementById("error_nome").innerHTML = "Preencha o campo com Nome e Sobrenome";
	return false;
    }else{
	if(document.getElementById("error_nome").style.display == 'block'){
	    document.getElementById("error_nome").style.display = 'none';
	}
	return true;
    }
}

function tel() {
    var ddd = document.getElementById("tel_ddd").value;
    var prefixo = document.getElementById("tel_prefixo").value;
    var sufixo = document.getElementById("tel_sufixo").value;
    document.getElementById("telefone_completo").value = "("+ddd+") "+prefixo+"-"+sufixo;
}

function cel() {
    var ddd = document.getElementById("cel_ddd").value;
    var celular = document.getElementById("cel_numero").value;
    
    document.getElementById("celular_completo").value = "("+ddd+") "+celular;
}

function fx() {
    var ddd = document.getElementById("fax_ddd").value;
    var fax = document.getElementById("fax_numero").value;
    
    document.getElementById("fax_completo").value = "("+ddd+") "+fax;
}

function mail() {
    var prefixo = document.getElementById("email_prefixo").value;
    var sufixo = document.getElementById("email_sufixo").value;
    
    document.getElementById("email_completo").value = prefixo+sufixo;
}


function ativarAndar(){
    if(document.getElementById("c_andar").checked){
        document.getElementById("andar").disabled = false;
    }else{
        document.getElementById("andar").disabled = true;
        document.getElementById("andar").value = "";
    }

}

function ativarSala(){
    if(document.getElementById("c_sala").checked){
        document.getElementById("sala").disabled = false;
    }else{
        document.getElementById("sala").disabled = true;
        document.getElementById("sala").value = "";
    }
}

function ativarVisualizar(){
    var nomeval = document.getElementById("nome").value;
    var nl = nomeval.length;
    var emailval = document.getElementById("email_prefixo").value;
    var el = emailval.length;
    
    if(nl>0){
        validarSobrenome = verificarSobrenome(nomeval);
    } else {
	validarSobrenome = false;
    }

    if((validarSobrenome) && (el > 0)){

	document.getElementById("btn_visualizar").disabled = false;
    }

}

function ativarAprovacao()
{

    document.getElementById("aprovar").disabled = false;

}

function aprovar()
{

    document.getElementById("btn_aprovar").disabled = false;

}

function adicionarCartoes()
{
    
    adicionarCartao();
    limparDados();
    document.getElementById("form_cartao").reset();
    document.getElementById("btn_solicitar").disabled = false;
    

}

function limparDados()
{
    document.getElementById("btn_visualizar").disabled = true;
    document.getElementById("aprovar").checked = false;
    document.getElementById("pdf").src = "";
    document.getElementById("btn_aprovar").disabled = true;
}


function visualizarPDF(usuario)
{
    var unidades = document.getElementById("unidades").value;
    var setor = document.getElementById("setores").value;
    var nome = document.getElementById("nome").value;
    var cargo = document.getElementById("cargo").value;
    var cargo_en = document.getElementById("cargo_en").value;
    var enderecos = document.getElementById("enderecos").value;
    var c_andar = document.getElementById("c_andar").value;
    var andar = document.getElementById("andar").value;
    var c_sala = document.getElementById("c_sala").value;
    var sala = document.getElementById("sala").value;
    var telefone_completo = document.getElementById("telefone_completo").value;
    var celular_completo = document.getElementById("celular_completo").value;
    var fax_completo = document.getElementById("fax_completo").value;
    var email_prefixo = document.getElementById("email_prefixo").value;
    var email_sufixo = document.getElementById("email_sufixo").value;

    email_sufixo = email_sufixo.replace('@', '')
    c_andar = c_andar.replace('/','_')
    c_sala = c_sala.replace('/','_')
    telefone_completo = telefone_completo.replace('(','_')
    telefone_completo = telefone_completo.replace(')','.')
    fax_completo = fax_completo.replace('(','_')
    fax_completo = fax_completo.replace(')','.')
    celular_completo = celular_completo.replace('(','_')
    celular_completo = celular_completo.replace(')','.')
    var dados = []
    var xhttp = new XMLHttpRequest();
        //  [  0      ,   1 , 2   ,  3   ,    4    ,    5     ,    6   ,  7   ,   8   ,   9 ,     10           ,     11          ,      12     ,     13       ,    14       ]
    dados = [unidades, setor, nome, cargo, cargo_en, enderecos, c_andar, andar, c_sala, sala, telefone_completo, celular_completo, fax_completo, email_prefixo, email_sufixo]
  
    
    xhttp.onreadystatechange = function(){
    	if(this.readyState == 4 && this.status == 200) {
    	   
           document.getElementById("pdf").src = "pdf/"+usuario+"/"+dados;
    	}

    };

    xhttp.open("GET", "pdf/"+usuario+"/"+dados, true);
    xhttp.send();
}

function adicionarCartao()
{
    var x = document.getElementById("form_cartao");
    
    var text = "";
    var name = "";
    var value = "";
    var i;
    var xhttp = new XMLHttpRequest();

    for (i = 0; i < x.length ; i++) 
    {
        if ((x.elements[i].type == "radio") && (x.elements[i].checked)) {
            text += x.elements[i].name + "=" + x.elements[i].value + "&";
            
        }
        else if ((x.elements[i].type == "checkbox") && (x.elements[i].checked)) {
            text += x.elements[i].name + "=" + x.elements[i].value + "&";
            
        }   
        else if((x.elements[i].type != "radio") && (x.elements[i].type != "checkbox")){
            text += x.elements[i].name + "=" + x.elements[i].value + "&";
            
        }
        
        
    }

    
    xhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200) {
        
        document.getElementById("cartoes").innerHTML = this.responseText;
    }

    };
    xhttp.open("POST", "adicionar_cartao/", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(text);
}

function removerCartao(value,usuario)
{
    tamanho = value.length;
    final = tamanho - 6;
    arquivo = value.substr(0,final);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200) {
        document.getElementById("cartoes").innerHTML = this.responseText;
    }

    };
    xhttp.open("GET", "remover_cartao/"+usuario+"/"+arquivo, true);
    xhttp.send();
}

function solicitarCartoes(usuario)
{

    window.location.assign("solicitar_pedido/"+usuario);


}
