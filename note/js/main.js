document.addEventListener('DOMContentLoaded', function () {
    const notesList = document.getElementById('notesList');
    const noteTitle = document.getElementById('noteTitle');
    const noteBody = document.getElementById('noteBody');
    const saveNoteBtn = document.getElementById('saveNoteBtn');
    let currentNoteId = null;

    function fetchNotes() {
        fetch('fetch_notes.php')
            .then(response => response.json())
            .then(notes => {
                notesList.innerHTML = '';
                notes.forEach(note => {
                    const noteElement = document.createElement('div');
                    noteElement.classList.add('notes__list-item');
                    noteElement.setAttribute('data-id', note.id);
                    noteElement.innerHTML = `
                        <div class="notes__small-title">${note.title || 'Untitled Note'}</div>
                        <div class="notes__small-body">${note.body || 'No Body'}</div>
                        <div class="notes__small-updated">${new Date(note.updated_at).toLocaleString() || 'No Date'}</div>
                        <button class="notes__delete" data-id="${note.id}">Delete</button>
                    `;
                    notesList.appendChild(noteElement);

                    noteElement.addEventListener('click', function () {
                        currentNoteId = note.id;
                        noteTitle.value = note.title;
                        noteBody.value = note.body;
                        saveNoteBtn.style.display = 'block'; 
                    });

                    const deleteButton = noteElement.querySelector('.notes__delete');
                    deleteButton.addEventListener('click', function (event) {
                        event.stopPropagation(); 
                        const confirmDelete = confirm("Are you sure you want to delete this note?");
                        if (confirmDelete) {
                            console.log("Deleting note with ID:", note.id); 
                            deleteNote(note.id); 
                        }
                    });
                });
            })
            .catch(error => console.error('Error fetching notes:', error));
    }

    function deleteNote(noteId) {
        fetch('delete_note.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: noteId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchNotes(); 
            } else {
                alert('Failed to delete the note: ' + data.message);
            }
        })
        .catch(error => console.error('Error deleting note:', error));
    }    
    

    document.getElementById('addNoteBtn').addEventListener('click', function () {
        fetch('create_note.php', { method: 'POST' })
            .then(response => response.text())
            .then(noteId => {
                currentNoteId = noteId;  
                noteTitle.value = '';  
                noteBody.value = '';
                saveNoteBtn.style.display = 'block';  
                fetchNotes();  
            })
            .catch(error => console.error('Error creating note:', error));
    });

    saveNoteBtn.addEventListener('click', function () {
        const data = new FormData();
        data.append('id', currentNoteId);  
        data.append('title', noteTitle.value);  
        data.append('body', noteBody.value);

        fetch('save_note.php', {
            method: 'POST',
            body: data
        }).then(() => {
            fetchNotes();  
        })
        .catch(error => console.error('Error saving note:', error));
    });


    fetchNotes();
});
