# Smart
Smart is a open-source modular dashboard for your mirror.

##Creating a new Module
Your Module could be a new Feature for any smart mirror. If you want to extend the system like described below.
New features means new ideas for everyone.
Your base Directory structure should looks like this:

**Your Module should be in this directory "App/Modules/":**

NewModule/Bootstrap.php

NewModule/Controllers/MyNewController.php

NewModule/Models/MyNewModel.php

NewModule/Services/MyNewService.php

**Your new Classes must extend the support classes! You find them here:**

*"Core\Controllers\Controller.php"*

*"Core\Models\Model.php"*

*"Core\Services\Service.php"*

### Creating new Controllers

### Creating new Services
### Creating new Models

##Todo´s
- Controller auto-registration
