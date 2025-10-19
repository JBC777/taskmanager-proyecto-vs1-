// Importar funciones si fueran exportadas (en este caso, están en el ámbito global)
// Para este proyecto simple, simularemos el DOM y usaremos las funciones directamente.
/**
 * @jest-environment jsdom
 */

const { addTask, deleteTask, completeTask, tasks } = require('../script.js'); // ✅ Importar correctamente

describe('TaskManager - Pruebas Unitarias', () => {
  beforeEach(() => {
    // Simular estructura básica del DOM
    document.body.innerHTML = `
      <input type="text" id="taskInput" />
      <ul id="taskList"></ul>
    `;
    tasks.length = 0; // Limpiar tareas antes de cada prueba
  });

  test('addTask agrega una tarea válida', () => {
    document.getElementById('taskInput').value = 'Nueva tarea';
    addTask();
    expect(tasks.length).toBe(1);
    expect(tasks[0].text).toBe('Nueva tarea');
    expect(tasks[0].completed).toBe(false);
    expect(document.getElementById('taskInput').value).toBe('');
  });

  test('addTask no agrega tareas vacías', () => {
    document.getElementById('taskInput').value = '';
    const alertMock = jest.spyOn(window, 'alert').mockImplementation(() => {});
    addTask();
    expect(tasks.length).toBe(0);
    expect(alertMock).toHaveBeenCalledWith('Por favor, escribe una tarea válida.');
    alertMock.mockRestore();
  });

  test('deleteTask elimina una tarea existente', () => {
    const taskId = Date.now();
    tasks.push({ id: taskId, text: 'Tarea a eliminar', completed: false });

    const taskList = document.getElementById('taskList');
    const li = document.createElement('li');
    li.dataset.id = taskId;

    const span = document.createElement('span');
    span.textContent = 'Tarea a eliminar';

    const buttonContainer = document.createElement('div');
    const fakeButton = document.createElement('button');
    buttonContainer.appendChild(fakeButton);

    li.appendChild(span);
    li.appendChild(buttonContainer);
    taskList.appendChild(li);

    deleteTask(fakeButton);

    expect(tasks.length).toBe(0);
  });

  // ✅ NUEVO TEST: Cobertura para completeTask()
  test('completeTask cambia el estado de una tarea correctamente', () => {
    // Preparar entorno DOM
    document.body.innerHTML = `
      <ul id="taskList"></ul>
      <input id="taskInput" value="Tarea para completar" />
    `;

    // Agregar tarea
    addTask();

    // Simular botón y li
    const li = document.querySelector('li');
    li.dataset.id = tasks[0].id;
    const fakeButton = document.createElement('button');
    li.appendChild(fakeButton);

    // Ejecutar la función
    completeTask({ parentElement: { parentElement: li } });

    // Verificar cambio de estado
    expect(tasks[0].completed).toBe(true);
  });
});
