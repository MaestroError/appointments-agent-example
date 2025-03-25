# appointments-agent-example

Check `config/laragent.php` for providers configurations. You will need ollama for local development or OpenAi api key to set in .env file.

## AppointmentAssistant

Located in `app/AiAgents/AppointmentAssistant.php`.

Tools:

- `checkAvailability`
- `bookAppointment`
- `transferToManager`

### Prompts

Check `resources\views\AppointmentAssistant` for prompts and tool results.

### Models

We use `Service` and `Slot` models for appointment scheduling. There are seeders to add some test data, so don't forget to run `db:seed` while installing this project.

### Testing agent

After setting up the project, you can test the agent by running `php artisan agent:chat AppointmentAssistant`

## License

MIT

## Credits

- [LarAgent](https://github.com/maestroerror/laragent)
- [Revaz Gh.](https://github.com/maestroerror)