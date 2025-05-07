document.getElementById("registerForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    if (!name || !email || !password) {
        alert("Будь ласка, заповніть усі поля.");
        return;
    }

    const response = await fetch('api/register.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({name, email, password})
    });

    const result = await response.json();
    alert(result.message);
});

async function loadUsers() {
    try {
        const res = await fetch('api/users.php');
        const users = await res.json();

        const list = document.getElementById('userList');
        list.innerHTML = '';
        users.forEach(user => {
            const li = document.createElement('li');
            li.innerHTML = `${user.name} (${user.email}) 
    <button onclick="deleteUser(${user.id})">Видалити</button>
    <button onclick="editUser(${user.id}, '${user.name}', '${user.email}')">Редагувати</button>`;

            list.appendChild(li);
        });
    } catch (err) {
        console.error("Помилка при завантаженні користувачів:", err);
    }
}

function editUser(id, currentName, currentEmail) {
    const name = prompt("Нове ім'я:", currentName);
    const email = prompt("Новий email:", currentEmail);

    if (!name || !email) return;

    fetch('api/update_user.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id, name, email})
    })
    .then(res => res.json())
    .then(result => {
        alert(result.message);
        loadUsers();
    });
}


async function deleteUser(id) {
    if (!confirm("Ви впевнені, що хочете видалити користувача?")) return;

    const res = await fetch('api/delete_user.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id})
    });

    const result = await res.json();
    alert(result.message);
    loadUsers();
}

document.getElementById("loginForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const email = document.getElementById("loginEmail").value.trim();
    const password = document.getElementById("loginPassword").value.trim();

    const res = await fetch('api/login.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({email, password})
    });

    const result = await res.json();
    alert(result.message);

    if (result.user) {
        localStorage.setItem('user', JSON.stringify(result.user));
        loadNotes();
    }
});
//2 завдання
document.getElementById("noteForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const user = JSON.parse(localStorage.getItem("user"));
    const title = document.getElementById("noteTitle").value.trim();
    const content = document.getElementById("noteContent").value.trim();

    if (!title || !content) {
        alert("Заповніть усі поля.");
        return;
    }

    const res = await fetch("api/create_note.php", {
        method: "POST",
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({user_id: user.id, title, content})
    });

    const result = await res.json();
    alert(result.message);
    document.getElementById("noteForm").reset();
    loadNotes();
});

async function loadNotes() {
    const user = JSON.parse(localStorage.getItem("user"));
    document.getElementById("notesSection").style.display = "block";

    const res = await fetch(`api/get_notes.php?user_id=${user.id}`);
    const notes = await res.json();

    const list = document.getElementById("noteList");
    list.innerHTML = '';
    notes.forEach(note => {
        const li = document.createElement("li");
        li.innerHTML = `<strong>${note.title}</strong><br>${note.content}<br>
        <button onclick="editNote(${note.id}, '${note.title}', \`${note.content}\`)">Редагувати</button>
        <button onclick="deleteNote(${note.id})">Видалити</button><hr>`;
        list.appendChild(li);
    });
}

function editNote(id, currentTitle, currentContent) {
    const title = prompt("Новий заголовок:", currentTitle);
    const content = prompt("Новий вміст:", currentContent);

    if (!title || !content) return;

    fetch('api/update_note.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id, title, content})
    })
    .then(res => res.json())
    .then(result => {
        alert(result.message);
        loadNotes();
    });
}

async function deleteNote(id) {
    if (!confirm("Ви впевнені, що хочете видалити нотатку?")) return;

    const res = await fetch('api/delete_note.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id})
    });

    const result = await res.json();
    alert(result.message);
    loadNotes();
}
