import os

HTML_OUTPUT_FILE = "vacancies_report.html"


def generate_html_report(conn):
    cursor = conn.cursor()
    cursor.execute("SELECT title, salary, company FROM vacancies")
    rows = cursor.fetchall()

    html_content = """<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вакансии hh.ru</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; padding: 20px; }
        h1 { color: #d32f2f; text-align: center; }
        table { width: 90%; margin: 20px auto; border-collapse: collapse; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.2); }
        th, td { border: 1px solid #ddd; padding: 12px 15px; text-align: left; }
        th { background-color: #d32f2f; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #f1f1f1; }
    </style>
</head>
<body>
    <h1>Результаты парсинга hh.ru</h1>
    <table>
        <thead>
            <tr>
                <th>Должность</th>
                <th>Зарплата</th>
                <th>Компания</th>
            </tr>
        </thead>
        <tbody>
"""

    for row in rows:
        title, salary, company = row
        html_content += f"""            <tr>
                <td>{title}</td>
                <td>{salary}</td>
                <td>{company}</td>
            </tr>\n"""

    html_content += """        </tbody>
    </table>
</body>
</html>"""

    with open(HTML_OUTPUT_FILE, "w", encoding="utf-8") as f:
        f.write(html_content)

    print(f"Отчет сгенерирован: {os.path.abspath(HTML_OUTPUT_FILE)}")
