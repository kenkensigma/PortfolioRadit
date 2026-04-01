@extends('dashboard.layout')
@section('title', 'Skills')
@section('breadcrumb', 'Skills')

@section('content')

<div class="dash-page-header">
    <div>
        <h1 class="dash-page-title">Skills</h1>
        <p class="dash-page-sub">Manage your expertise cards shown on the portfolio.</p>
    </div>
    <button class="btn-primary" id="btnAddSkill"><span>+</span> Add Skill</button>
</div>

@if(session('success'))
    <div class="dash-flash dash-flash--success">✓ {{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="dash-flash dash-flash--error">⚠ {{ $errors->first() }}</div>
@endif

@if($skills->isEmpty())
    <div class="data-table-empty">
        <span>⬡</span>
        <p>No skills yet. Add your first skill card.</p>
    </div>
@else
<div class="skills-dash-grid">
    @foreach($skills as $skill)
    <div class="skill-dash-card">
        <div class="skill-dash-card__top">
            <span class="skill-dash-card__icon">{{ $skill->icon }}</span>
            <div class="skill-dash-card__actions">
                <button class="btn-icon" title="Edit"
                    data-id="{{ $skill->id }}"
                    data-icon="{{ $skill->icon }}"
                    data-title="{{ $skill->title }}"
                    data-desc="{{ $skill->description }}"
                    data-tags="{{ implode(', ', $skill->tags ?? []) }}"
                    onclick="openEditSkill(this)">✎</button>

                <form method="POST" action="{{ route('dashboard.skills.destroy', $skill) }}" style="display:inline"
                    onsubmit="return confirm('Delete skill &quot;{{ addslashes($skill->title) }}&quot;?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-icon btn-icon--danger" title="Delete">✕</button>
                </form>
            </div>
        </div>
        <div class="skill-dash-card__title">{{ $skill->title }}</div>
        <div class="skill-dash-card__desc">{{ $skill->description }}</div>
        <div class="skill-dash-card__tags">
            @foreach($skill->tags ?? [] as $tag)
                <span class="skill-dash-card__tag">{{ $tag }}</span>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endif

{{-- ADD / EDIT SKILL MODAL --}}
<div class="modal" id="skillModal">
    <div class="modal__box">
        <div class="modal__header">
            <h2 class="modal__title" id="skillModalTitle">Add Skill</h2>
            <button class="modal__close" data-close="skillModal">✕</button>
        </div>
        <div class="modal__body">
            <form id="skillForm" method="POST" novalidate>
                @csrf
                <input type="hidden" name="_method" id="skillMethod" value="POST">

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="sTitle">Skill Title *</label>
                        <input class="form-input" type="text" name="title" id="sTitle" placeholder="e.g. Backend Development" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="sIcon">Icon / Symbol</label>
                        <input class="form-input" type="text" name="icon" id="sIcon" placeholder="⬡">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="sDesc">Description *</label>
                    <textarea class="form-input form-textarea" name="description" id="sDesc" rows="3" placeholder="What you do in this area..." required></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="sTags">Tags</label>
                    <input class="form-input" type="text" name="tags" id="sTags" placeholder="PHP, Laravel, Node.js">
                </div>

                <div class="modal__footer">
                    <button type="button" class="btn-ghost" data-close="skillModal">Cancel</button>
                    <button type="submit" class="btn-primary">Save Skill</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const backdrop    = document.getElementById('modalBackdrop');
const modal       = document.getElementById('skillModal');
const form        = document.getElementById('skillForm');
const methodInp   = document.getElementById('skillMethod');
const modalTitle  = document.getElementById('skillModalTitle');
const storeUrl    = '{{ route('dashboard.skills.store') }}';

document.getElementById('btnAddSkill').addEventListener('click', () => {
    form.action     = storeUrl;
    methodInp.value = 'POST';
    modalTitle.textContent = 'Add Skill';
    form.reset();
    openModal();
});

function openEditSkill(btn) {
    form.action     = '/dashboard/skills/' + btn.dataset.id;
    methodInp.value = 'PUT';
    modalTitle.textContent = 'Edit Skill';
    document.getElementById('sIcon').value  = btn.dataset.icon;
    document.getElementById('sTitle').value = btn.dataset.title;
    document.getElementById('sDesc').value  = btn.dataset.desc;
    document.getElementById('sTags').value  = btn.dataset.tags;
    openModal();
}

function openModal()  { modal.classList.add('open'); backdrop.classList.add('open'); document.body.style.overflow='hidden'; }
function closeModal() { modal.classList.remove('open'); backdrop.classList.remove('open'); document.body.style.overflow=''; }

document.querySelectorAll('[data-close]').forEach(b => b.addEventListener('click', closeModal));
backdrop.addEventListener('click', closeModal);
</script>

@endsection
