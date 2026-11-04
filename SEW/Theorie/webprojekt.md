### 1) Neue Solution anlegen
- Web Projekt (Blazor Web)
- (Nuget: Pomelo.EntityFrameworkCore.MySQL 9.0, 
- Microsoft.EntityFrameworkCore.Design 9.0)
- Classlibrary
    - Configuration
    - Entities
    - Ressources
    - (Nuget: Nuget: Pomelo.EntityFrameworkCore.MySQL 9.0, 
    - Microsoft.EntityFrameworkCore.Tools 9.0)
- Classlibrary (Domain)
    - Repositories
        - Interfaces
        - Implementations

### 2) DbContext anlegen (Model/Configuration)
- Configuration
```
// Der DbContext ist die Schnittstelle zwischen dem Programm und der Datenbank.
// Der DbContext ist Teil eines ORM Frameworks. 
// ORM steht für Object-Relational-Mapping.
// Ziel ist es nach einer kurzen Konfigurationsphase Objekte ohne sql Code
// aus der Datenbank zu lesen bzw. Objekte in die Datenbank zu schreiben.

// 1) Schritt - Definieren von Entitäten. Die Entitäten sind die Objekte die in
// der Datenbank gespeichert werden sollen. Zusätzlich definieren die Entitäten
// die Struktur der Tabellen des jeweiligen Speicherorts. 

public class PlaybookDbContext : DbContext
{
    // Registrieren einer Entität mit dem DbContext
    public DbSet<Author> Authors { get; set; }

    public PlaybookDbContext(DbContextOptions<PlaybookDbContext> options) : base(options)
    {
        
    }
}

```

### 3) Entity anlegen
```
// Mit der Table Annotation wird das Framework angewiesen einer Tabelle mit dem
// Namen Authors anzulegen. Objekte der Klasse Author werden in dieser Tabelle
// gespeichert. 

[Table("AUTHORS")]
public class Author
{
    // Die Key Annotation zeichnet die ID Property als Schlüssel aus.
    // Mit der DatabaseGenerated Annotation wird die Datenbank angewiesen
    // den Wert des Schlüssel zu generieren. 
    
    [Key, DatabaseGenerated(DatabaseGeneratedOption.Identity)]
    [Column("AUTHOR_ID")]
    public int Id { get; set; }
}
```

### 4) DbContext File Registrieren

```
// Im Program.cs File des Web Projekts erfolgt die gesamte Konfiguration
// des Projekts. Um programmtechnisch auf die Datenbank zugreifen
// zu können muss der DbContext im Programm registriert werden. 

builder.Services.AddDbContextFactory<PlaybookDbContext>(
    options => options.UseMySql(
        builder.Configuration.GetConnectionString("DefaultConnection"), 
        new MySqlServerVersion(new Version(8,0,43))
    )
);
```

### 5) Datenbankzugriff konfigurieren im appsettings.json
```
"ConnectionStrings": {
  "DefaultConnection": "server=localhost; port=3306; database=playbook; user=root; password=root; Persist Security Info=False; Connect Timeout=300"
}
```

### 6) Dotnet Tools installieren
```
dotnet tool install --global dotnet-ef --version "9.0.*"
```

### 7) Befehle zum Generieren der Datenbankstruktur
```
dotnet ef -s ..\WebGui\ migrations add InitCreate
dotnet ef -s ..\WebGui\ database update
```