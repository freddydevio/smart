# Smart
"smart" is a open-source modular dashboard for your mirror.

## Creating a new Module
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
Your Controller should call a service to handle something and get a callback with repsonse.
### Creating new Services
Your Services should contain your data transfers like get data or send data and work with data.
### Creating new Models
Your Model should be the transfer object for example for the database.
## Todo´s
- Controller auto-registration
- Full user documentation
- Full developer documentation
