# Simple Blog System

Create a basic blog system with features like creating, updating, and deleting posts. Implement basic authentication for authors.

---

## Notes

The only missing part was the last one, the **authentication for authors**, and one of the causes was the poor
preparation for the challenge, and in this case was not about the knowledge, it was more about problems with the DB configuration, and I totally forgot to include the ```ENV``` values, like
de ```DB_NAME```, ```DB_PASS```, etc.

For new challenges I will start the server first, and verify the connection with the DB is correct before beginning with the challenge.

I don't forget to sanitize the inputs, it's just that in this case I don't care, because the challenge is not to complicated and is not necessary, at
least because this code is not going to be on a production server, is for learning purposes and if other challenges demands the sanitization, I'll do it
without any problem, but it's not important in this case.