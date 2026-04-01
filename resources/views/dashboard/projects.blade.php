@extends('dashboard.layout')
@section('title', 'Projects')
@section('breadcrumb', 'Projects')

@section('content')

<div class="dash-page-header">
    <div>
        <h1 class="dash-page-title">Projects</h1>
        <p class="dash-page-sub">Add, edit, and reorder your portfolio projects.</p>
    </div>
    <button class="btn-primary" id="btnAddProject">
        <span>+</span> Add Project
    </button>
</div>

@if(session('success'))
    <div class="dash-flash dash-flash--success">✓ {{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="dash-flash dash-flash--error">⚠ {{ $errors->first() }}</div>
@endif

@if($projects->isEmpty())
    <div class="data-table-empty">
        <span>◫</span>
        <p>No projects yet. Click "Add Project" to get started.</p>
    </div>
@else
<div class="data-table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width:40px">#</th>
                <th>Title</th>
                <th>Type</th>
                <th>Stack</th>
                <th>Accent</th>
                <th style="width:130px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $i => $project)
            <tr>
                <td style="color:rgba(255,255,255,0.25);font-size:11px">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</td>
                <td><strong>{{ $project->title }}</strong></td>
                <td>{{ $project->type }}</td>
                <td>
                    <div class="table-stack">
                        @foreach($project->stack ?? [] as $tech)
                            <span class="table-tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="table-color-dot" style="background:{{ $project->accent_color }}"></span>
                    <span style="font-size:11px;color:rgba(255,255,255,0.3)">{{ $project->accent_color }}</span>
                </td>
                <td>
                    <div class="table-actions">
                        <button class="btn-icon" title="Edit"
                            data-id="{{ $project->id }}"
                            data-title="{{ $project->title }}"
                            data-type="{{ $project->type }}"
                            data-desc="{{ $project->description }}"
                            data-stack="{{ implode(', ', $project->stack ?? []) }}"
                            data-accent="{{ $project->accent_color }}"
                            data-bg="{{ $project->bg_color }}"
                            data-url="{{ $project->url ?? '' }}"
                            onclick="openEditProject(this)">✎</button>

                        <form method="POST" action="{{ route('dashboard.projects.destroy', $project) }}" style="display:inline"
                            onsubmit="return confirm('Delete project &quot;{{ addslashes($project->title) }}&quot;? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon btn-icon--danger" title="Delete">✕</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{-- ADD / EDIT MODAL --}}
<div class="modal" id="projectModal">
    <div class="modal__box">
        <div class="modal__header">
            <h2 class="modal__title" id="projectModalTitle">Add Project</h2>
            <button class="modal__close" data-close="projectModal">✕</button>
        </div>
        <div class="modal__body">
            <form id="projectForm" method="POST" novalidate>
                @csrf
                <input type="hidden" name="_method" id="projectMethod" value="POST">

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="pTitle">Project Title *</label>
                        <input class="form-input" type="text" name="title" id="pTitle" placeholder="e.g. Nexus Commerce" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pType">Type / Category *</label>
                        <input class="form-input" type="text" name="type" id="pType" placeholder="e.g. E-Commerce Platform" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="pDesc">Description *</label>
                    <textarea class="form-input form-textarea" name="description" id="pDesc" rows="3" placeholder="Short description..." required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="pStack">Tech Stack</label>
                        <input class="form-input" type="text" name="stack" id="pStack" placeholder="Laravel, MySQL, Redis">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pAccent">Accent Color</label>
                        <div class="color-pick-row">
                            <input class="form-input" type="text" name="accent_color" id="pAccent" placeholder="#4f46e5">
                            <input class="color-swatch" type="color" id="pAccentPicker" value="#4f46e5">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="pBg">Card Background</label>
                        <div class="color-pick-row">
                            <input class="form-input" type="text" name="bg_color" id="pBg" placeholder="#1a1a2e">
                            <input class="color-swatch" type="color" id="pBgPicker" value="#1a1a2e">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pUrl">Project URL</label>
                        <input class="form-input" type="url" name="url" id="pUrl" placeholder="https://...">
                    </div>
                </div>

                <div class="modal__footer">
                    <button type="button" class="btn-ghost" data-close="projectModal">Cancel</button>
                    <button type="submit" class="btn-primary">Save Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const backdrop   = document.getElementById('modalBackdrop');
const modal      = document.getElementById('projectModal');
const form       = document.getElementById('projectForm');
const methodInp  = document.getElementById('projectMethod');
const modalTitle = document.getElementById('projectModalTitle');
const storeUrl   = '{{ route('dashboard.projects.store') }}';

document.getElementById('btnAddProject').addEventListener('click', () => {
    form.action     = storeUrl;
    methodInp.value = 'POST';
    modalTitle.textContent = 'Add Project';
    form.reset();
    syncPickerFromText('pAccent','pAccentPicker','#4f46e5');
    syncPickerFromText('pBg','pBgPicker','#1a1a2e');
    openModal();
});

function openEditProject(btn) {
    const id = btn.dataset.id;
    form.action     = '/dashboard/projects/' + id;
    methodInp.value = 'PUT';
    modalTitle.textContent = 'Edit Project';
    document.getElementById('pTitle').value  = btn.dataset.title;
    document.getElementById('pType').value   = btn.dataset.type;
    document.getElementById('pDesc').value   = btn.dataset.desc;
    document.getElementById('pStack').value  = btn.dataset.stack;
    document.getElementById('pAccent').value = btn.dataset.accent;
    document.getElementById('pBg').value     = btn.dataset.bg;
    document.getElementById('pUrl').value    = btn.dataset.url;
    syncPickerFromText('pAccent','pAccentPicker', btn.dataset.accent);
    syncPickerFromText('pBg','pBgPicker', btn.dataset.bg);
    openModal();
}

function syncPickerFromText(textId, pickerId, val) {
    document.getElementById(textId).value   = val;
    document.getElementById(pickerId).value = val;
}

function openModal()  { modal.classList.add('open'); backdrop.classList.add('open'); document.body.style.overflow='hidden'; }
function closeModal() { modal.classList.remove('open'); backdrop.classList.remove('open'); document.body.style.overflow=''; }

document.querySelectorAll('[data-close]').forEach(b => b.addEventListener('click', closeModal));
backdrop.addEventListener('click', closeModal);

// Color picker sync
['pAccent','pBg'].forEach(id => {
    const textEl   = document.getElementById(id);
    const pickerId = id + 'Picker';
    const pickerEl = document.getElementById(pickerId);
    pickerEl.addEventListener('input', () => textEl.value = pickerEl.value);
    textEl.addEventListener('input',   () => { if (/^#[0-9A-Fa-f]{6}$/.test(textEl.value)) pickerEl.value = textEl.value; });
});
</script>

@endsection
