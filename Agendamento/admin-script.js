// Simulação de dados de agendamentos
const agendamentos = [
    { id: 1, cliente: "João Silva", servico: "Corte de Cabelo", data: "2024-12-01", horario: "10:00" },
    { id: 2, cliente: "Maria Oliveira", servico: "Manicure", data: "2024-12-01", horario: "11:30" },
  ];
  
  // Função para carregar a lista de agendamentos
  function carregarAgendamentos() {
    const tabela = document.querySelector("#agendamentos-table tbody");
    tabela.innerHTML = ""; // Limpa a tabela
  
    agendamentos.forEach((agendamento) => {
      const linha = document.createElement("tr");
  
      linha.innerHTML = `
        <td>${agendamento.cliente}</td>
        <td>${agendamento.servico}</td>
        <td>${agendamento.data}</td>
        <td>${agendamento.horario}</td>
        <td>
          <button class="btn-edit" onclick="editarAgendamento(${agendamento.id})">Editar</button>
          <button class="btn-delete" onclick="excluirAgendamento(${agendamento.id})">Excluir</button>
        </td>
      `;
  
      tabela.appendChild(linha);
    });
  }
  
  // Função para editar um agendamento
  function editarAgendamento(id) {
    const agendamento = agendamentos.find((ag) => ag.id === id);
    if (agendamento) {
      const novoHorario = prompt(`Edite o horário para ${agendamento.cliente} (${agendamento.servico}):`, agendamento.horario);
      if (novoHorario) {
        agendamento.horario = novoHorario;
        carregarAgendamentos();
      }
    }
  }
  
  // Função para excluir um agendamento
  function excluirAgendamento(id) {
    const index = agendamentos.findIndex((ag) => ag.id === id);
    if (index !== -1) {
      if (confirm("Tem certeza que deseja excluir este agendamento?")) {
        agendamentos.splice(index, 1);
        carregarAgendamentos();
      }
    }
  }
  
  // Manipulação do formulário de horários disponíveis
  document.querySelector("#horarios-form").addEventListener("submit", (e) => {
    e.preventDefault();
  
    const servico = document.querySelector("#service").value;
    const horarios = document.querySelector("#available-times").value;
  
    if (servico && horarios) {
      alert(`Horários para ${servico} salvos: ${horarios}`);
      document.querySelector("#horarios-form").reset();
    } else {
      alert("Por favor, preencha todos os campos.");
    }
  });
  
  // Inicializar a tabela ao carregar a página
  carregarAgendamentos();
  