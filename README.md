# Mini Issue Tracker (Laravel)

Mini-tracker për projekte dhe çështje (issues), me etiketa (tags) dhe komente.  
Përdor **Blade + AJAX** për disa ndërveprime pa reload dhe kujdeset për N+1 me **eager loading**.

## Çfarë përmban

- **Projects**
  - List / Create / Edit / Delete
  - Project **show** me listimin e issues të atij projekti
- **Issues**
  - Listim me **filters** (status, priority, tag)
  - **Search me debounce (AJAX)** gjatë shkrimit
  - Create / Edit / Delete
  - Issue **show**
- **Tags**
  - Create / List / Delete
  - **Attach/Detach te një issue (AJAX, pa reload)**
- **Comments**
  - Ngarkim i komenteve te issue **me AJAX** (paginated)
  - **Shtim komenti me AJAX** (prepend + pastrim i formës)
- **Të tjera**
  - **Eager loading** për të shmangur N+1
  - **Migrations, factories, seeders** për demo data
  - **Pagination** e thjeshtë me stil të pastër në Blade

### Bonus (të implementuara)
- **Members / Assignees**: lidhje many-to-many `users ↔ issues` + **attach/detach me AJAX** te faqja e issue.

> Shënim: Auth UI (p.sh. Breeze) **nuk është pjesë e këtij repo-je**; politikat funksionojnë sapo të aktivizosh autentikimin dhe middleware-t në app-in tënd.

---

## Setup

1. **Instalimi**
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
