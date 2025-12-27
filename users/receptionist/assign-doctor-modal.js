// Simple modal state
let modalData = { patientId: null };

const HARD_CODED_DOCTORS = [
  { id: 4, name: "Dr. Amun Sir", specialty: "Emergency Medicine", patients: "24 active patients" },
  { id: 5, name: "Dr. Courtney Henry", specialty: "Cardiology", patients: "18 active patients" },
  { id: 6, name: "Dr. Marvin McKinney", specialty: "Internal Medicine", patients: "15 active patients" }
];

function closeModal() {
  const bg = document.getElementById('doctorModalBg');
  if (!bg) return;
  bg.classList.remove('active');
  modalData.patientId = null;
}

function openDoctorModal(patientId) {
  modalData.patientId = patientId;
  const bg = document.getElementById('doctorModalBg');
  const grid = document.getElementById('doctorGrid');
  if (!bg || !grid) return;

  grid.innerHTML = "";
  HARD_CODED_DOCTORS.forEach(doc => {
    const card = document.createElement('button');
    card.type = 'button';
    card.className = 'doctor-card';
    card.innerHTML = `
      <span class="doctor-card-name">${doc.name}</span>
      <span class="doctor-card-meta">${doc.specialty}</span>
      <span class="doctor-card-meta">${doc.patients}</span>
    `;
    card.addEventListener('click', () => selectDoctor(doc.id, doc.name));
    grid.appendChild(card);
  });

  bg.classList.add('active');
}

function wireRowMenus() {
  document.addEventListener('click', function (e) {
    // Toggle row action menu
    const kebabBtn = e.target.closest('.kebab-btn');
    if (kebabBtn) {
      e.stopPropagation();
      const rowAction = kebabBtn.closest('.row-action');
      document.querySelectorAll('.row-action.open').forEach(el => {
        if (el !== rowAction) el.classList.remove('open');
      });
      rowAction.classList.toggle('open');
      return;
    }

    // Assign doctor from row menu
    const assignBtn = e.target.closest('.assign-doctor-trigger');
    if (assignBtn) {
      const rowAction = assignBtn.closest('.row-action');
      const patientId = rowAction.getAttribute('data-patient-id');
      rowAction.classList.remove('open');
      openDoctorModal(patientId);
      return;
    }

    // Click outside closes any open menus
    document.querySelectorAll('.row-action.open').forEach(el => el.classList.remove('open'));
  });
}

function selectDoctor(doctorId, doctorName) {
  const patientId = modalData.patientId;
  if (!patientId) return;

  fetch('assign-doctor.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `doctor_id=${encodeURIComponent(doctorId)}&patient_id=${encodeURIComponent(patientId)}`
  })
    .then(async (r) => {
      let data = {};
      try {
        data = await r.json();
      } catch (e) {
        console.error("Failed to parse assign-doctor response", e);
      }
      if (data && data.success) {
        alert(`Assigned ${doctorName} to patient.`);
        closeModal();
      } else {
        alert('Assignment failed.');
      }
    })
    .catch((e) => {
      console.error("Assign doctor request failed", e);
      alert('Assignment failed.');
    });
}

document.addEventListener('DOMContentLoaded', function () {
  document.body.insertAdjacentHTML('beforeend', `
    <div class="modal-bg" id="doctorModalBg">
      <div class="modal" id="doctorModal">
        <h3 style="margin-top:0;margin-bottom:1rem;font-size:1.2rem">Assign Doctor</h3>
        <div class="doctor-grid" id="doctorGrid"></div>
        <div style="text-align:right;">
          <button type="button" onclick="closeModal()" class="btn secondary" style="margin-top:0.3em">Cancel</button>
        </div>
      </div>
    </div>
  `);

  const bg = document.getElementById('doctorModalBg');
  if (bg) {
    bg.addEventListener('click', function (e) {
      if (e.target === this) closeModal();
    });
  }

  wireRowMenus();
});
