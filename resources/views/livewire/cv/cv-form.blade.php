<div class="space-y-6">
    <!-- Profile summary -->
    <livewire:cv.sections.profile-summary-form :userCv="$userCv" />

    <!-- Education -->
    <livewire:cv.sections.education-form :userCv="$userCv" />

    <!-- Work Experience -->
    <livewire:cv.sections.work-experience-form :userCv="$userCv" />
    
    <!-- Projects -->
    <livewire:cv.sections.projects-form :userCv="$userCv" />
    
    <!-- Certifications -->
    <livewire:cv.sections.certification-form :userCv="$userCv" />
    
    <!-- Languages -->
    <livewire:cv.sections.language-form :userCv="$userCv" />
    
    <!-- Skills -->
    <livewire:cv.sections.skills-form :userCv="$userCv" />
</div>
