// Simple modal state
let modalData = { patientId: null };

function closeModal() {
    document.querySelector('.modal-bg').classList.remove('active');
    modalData.patientId = null;
}

// Show modal and load doctors via fetch (or inline if you wish)
document.addEventListener('DOMContentLoaded', function() {
  document.body.insertAdjacentHTML('beforeend', `
    <div class="modal-bg" id="doctorModalBg">
      <div class="modal" id="doctorModal">
        <h3 style="margin-top:0;margin-bottom:1.17em;font-size:1.23em">Assign Doctor</h3>
        <ul class="modal-list" id="doctorList">
        </ul>
        <div>
          <button onclick="closeModal()" class="btn secondary" style="margin-top:0.3em">Cancel</button>
        </div>
      </div>
    </div>
  `);

  // Open modal on any assign button
  document.querySelectorAll('.assign-doctor-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const group = e.target.closest('.assign-doctor-group');
      modalData.patientId = group.getAttribute('data-patient-id');
      // Request possible doctors via hidden inline fetch (php echo below fills list!)
      fetch('get-doctors.php')
        .then(res => res.json())
        .then(doctors => {
          const list = document.getElementById('doctorList');
          list.innerHTML = '';
          doctors.forEach(doc => {
            const li = document.createElement('li');
            li.innerHTML = `<i class='ri-user-heart-line'></i> ${doc.name}`;
            li.onclick = () => selectDoctor(doc.id, doc.name);
            list.appendChild(li);
          });
        });
      document.querySelector('.modal-bg').classList.add('active');
    });
  });

  document.querySelector('.modal-bg').addEventListener('click', function(e){
    if (e.target === this) closeModal();
  });
});

function selectDoctor(doctorId, doctorName) {
  // Send assignment to backend (can be async or just form post)
  // We'll use AJAX for smooth UX:
  const patientId = modalData.patientId;
  fetch('assign-doctor.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `doctor_id=${doctorId}&patient_id=${patientId}`
  }).then(r => r.json())
    .then(data => {
      if (data.success) {
        // Update UI
        document.querySelector(`.assign-doctor-group[data-patient-id='${patientId}'] .assigned-doctor`).textContent = doctorName;
        document.querySelector(`.assign-doctor-group[data-patient-id='${patientId}'] .doctor-label`).textContent = doctorName;
        document.querySelector(`.assign-doctor-group[data-patient-id='${patientId}'] .assigned-doctor`).style.display = 'inline';
        closeModal();
      } else {
        alert('Assignment failed.');
      }
    });
}

