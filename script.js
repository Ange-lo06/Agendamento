// Variável para armazenar os agendamentos disponíveis
var agendamentosDisponiveis = [];
// Requisição para obter os agendamentos disponíveis
fetch('./getAgendamentoDisponivel.php')
	.then(response => response.json())
	.then(data => {
        agendamentosDisponiveis = data;
		// Extrai os serviços disponíveis
		const servicosDisponiveis = [...new Set(data.map(linha => linha.age_servico))];
		// Preenche a lista de serviços
		document.querySelector('#servico').innerHTML = `
            <option value="" disabled selected>Selecione o serviço</option>
			${servicosDisponiveis.map(servico => {
				return `<option value="${servico}">${servico}</option>`;
			}).join('')}
		`;
	})
	.catch(error => console.error('Erro ao ler os dias disponíveis:', error));

// Adiciona evento no select de serviço
document.querySelector('#servico').addEventListener('change', event => {
    const servicoSelecionado = event.target.value;
    // Filtra os agendamentos disponíveis pelo serviço selecionado
    const servicosDisponiveis = agendamentosDisponiveis.filter(linha => linha.age_servico === servicoSelecionado);
    // Extrai as datas disponíveis
    const datasOpcoes = [...new Set(servicosDisponiveis.map(linha => {
        const [ano, mes, dia] = linha.age_data.split('-');
        return `<option value="${linha.age_data}">${dia}/${mes}/${ano}</option>`;
    }))];
    // Preenche a lista de datas
    document.querySelector('#data').innerHTML = `
        <option value="" disabled selected>Selecione uma data</option>
        ${datasOpcoes}
    `;
});

// Adiciona evento no select de data
document.querySelector('#data').addEventListener('change', event => {
	const diaSelecionado = event.target.value;
    const servicoSelecionado = document.querySelector('#servico').value;
	// Filtra os agendamentos disponíveis pelo serviço e data selecionados
	const horariosDisponiveisDoDia = agendamentosDisponiveis.filter(linha => linha.age_data === diaSelecionado && linha.age_servico === servicoSelecionado);
	// Extrai os horários disponíveis
	const horariosOpcoes = horariosDisponiveisDoDia.map(linha => `<option value="${linha.age_horario}">${linha.age_horario.substr(0, 5)}</option>`).join('');
	// Preenche a lista de horários
	document.querySelector('#horario').innerHTML = `
		<option value="" disabled selected>Selecione o horário</option>
		${horariosOpcoes}
	`;
});


