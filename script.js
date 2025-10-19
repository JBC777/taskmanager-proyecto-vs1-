// ==================================================
// TASKMANAGER - Lógica Principal del Sistema
// Autor: Jaime Bolívar Castañeda
// Proyecto para la materia: Estándares y Métricas de Calidad de Software
// Mejorado según plan de acción (Actividad Final)
// ==================================================

// Array (matriz) en memoria que almacena todas las tareas
let tasks = [];

/**
 * Agrega una nueva tarea a la lista.
 * Valida que el campo de entrada no esté vacío.
 * @function addTask
 * @returns {void}
 */
function addTask() {
  // 1. Obtener el campo de texto y su valor
  const input = document.getElementById("taskInput");
  const taskText = input.value.trim(); // Elimina espacios al inicio y final

  // 2. Validar que no esté vacío
  // ✅ CORRECCIÓN T-01: Se reemplazó '==' por '===' para comparación estricta (ISO/IEC 25021 - Fiabilidad)
  if (taskText === "") {
    alert("Por favor, escribe una tarea válida.");
    return; // Detiene la función si está vacío
  }

  // 3. Crear un nuevo objeto "tarea"
  const newTask = {
    id: Date.now(), // Genera un ID único basado en la fecha/hora actual
    text: taskText,
    completed: false // Por defecto, la tarea no está completada
  };

  // 4. Agregar la tarea al array
  tasks.push(newTask);

  // 5. Limpiar el campo de texto
  input.value = "";

  // 6. Actualizar la interfaz (renderizar la lista de tareas)
  renderTasks();
}

/**
 * Marca una tarea como completada o pendiente.
 * @function completeTask
 * @param {HTMLButtonElement} button - Botón "Completar" o "Deshacer" clickeado
 * @returns {void}
 */
function completeTask(button) {
  // 1. Obtener el <li> padre del botón clickeado
  const taskItem = button.parentElement.parentElement;

  // 2. Obtener el ID de la tarea usando dataset
  // ✅ CORRECCIÓN T-02: Se reemplazó '.getAttribute("data-id")' por '.dataset.id' (ISO/IEC 25024 - Mantenibilidad)
  const taskId = parseInt(taskItem.dataset.id);

  // 3. Buscar la tarea en el array y cambiar su estado
  // ✅ CORRECCIÓN T-01: Comparación estricta con '==='
  const task = tasks.find(t => t.id === taskId);
  if (task) {
    task.completed = !task.completed; // Cambia de true a false, o viceversa
  }

  // 4. Actualizar la interfaz
  renderTasks();
}

/**
 * Elimina una tarea de la lista.
 * @function deleteTask
 * @param {HTMLButtonElement} button - Botón "Eliminar" clickeado
 * @returns {void}
 */
function deleteTask(button) {
  // 1. Obtener el <li> padre del botón clickeado
  const taskItem = button.parentElement.parentElement;

  // 2. Obtener el ID de la tarea usando dataset
  // ✅ CORRECCIÓN T-02: Se reemplazó '.getAttribute("data-id")' por '.dataset.id'
  // ❌ ERROR ANTERIOR: 'taskItem.dataset.id("data-id")' → sintaxis inválida
  const taskId = parseInt(taskItem.dataset.id);

  // 3. Filtrar el array para eliminar la tarea
  // ✅ CORRECCIÓN T-01: Comparación estricta con '!==' 
  tasks = tasks.filter(t => t.id !== taskId);

  // 4. Actualizar la interfaz
  renderTasks();
}

/**
 * Renderiza (muestra) todas las tareas en la interfaz.
 * Crea dinámicamente los elementos <li> con sus botones.
 * @function renderTasks
 * @returns {void}
 */
function renderTasks() {
  // 1. Obtener el elemento <ul> donde se mostrarán las tareas
  const taskList = document.getElementById("taskList");

  // 2. Limpiar la lista actual
  taskList.innerHTML = "";

  // 3. Recorrer el array de tareas y crear un <li> para cada una
  tasks.forEach(task => {
    // Crear elemento <li>
    const li = document.createElement("li");

    // ✅ CORRECCIÓN T-02: Asignar el ID usando dataset (solo esta línea es necesaria)
    li.dataset.id = task.id;

    // Aplicar clase "completed" si la tarea está completada
    if (task.completed) {
      li.classList.add("completed");
    }

    // Crear el span con el texto de la tarea
    const span = document.createElement("span");
    span.textContent = task.text;

    // Crear el contenedor de botones
    const buttonContainer = document.createElement("div");

    // Crear botón "Completar" / "Deshacer"
    const completeBtn = document.createElement("button");
    completeBtn.className = "complete-btn";
    completeBtn.textContent = task.completed ? "↩️ Deshacer" : "✔️ Completar";
    completeBtn.addEventListener("click", function() {
      completeTask(completeBtn);
    });

    // Crear botón "Eliminar"
    const deleteBtn = document.createElement("button");
    deleteBtn.className = "delete-btn";
    deleteBtn.textContent = "🗑️ Eliminar";
    deleteBtn.addEventListener("click", function() {
      deleteTask(deleteBtn);
    });

    // Añadir botones al contenedor
    buttonContainer.appendChild(completeBtn);
    buttonContainer.appendChild(deleteBtn);

    // Añadir span y botones al <li>
    li.appendChild(span);
    li.appendChild(buttonContainer);

    // Agregar el <li> a la lista
    taskList.appendChild(li);
  });
}