HTML_OUTPUT_FILE = "vacancies_report.html"


def generate_html_report(conn):
    cursor = conn.cursor()
    cursor.execute("SELECT title, company, experience FROM vacancies")
    rows = cursor.fetchall()

    html_content = """<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вакансии hh.ru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Результаты парсинга hh.ru</h1>
    <table>
        <thead>
            <tr>
                <th>Должность</th>
                <th>Компания</th>
                <th>Опыт работы</th>
            </tr>
        </thead>
        <tbody>
        """

    for row in rows:
        title, company, experience = row
        html_content += f"""
            <tr>
                <td>{title}</td>
                <td>{company}</td>
                <td>{experience}</td>
            </tr>
        """

    html_content += """
        </tbody>
    </table>
</body>
</html>"""

    with open(HTML_OUTPUT_FILE, "w", encoding="utf-8") as f:
        f.write(html_content)

    print(f"Отчет сгенерирован: {HTML_OUTPUT_FILE}")
