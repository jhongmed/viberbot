# GitHub Workflow Guide for PHP Developers

This guide provides a standard Git workflow for PHP developers contributing to the viberbot project.

## Prerequisites

Before you start, ensure you have:
- Git installed and configured
- GitHub account with access to the repository
- PHP 8.0+ installed
- Composer installed
- A code editor (VS Code, PHPStorm, etc.)

---

## 1. Initial Setup

### Clone the Repository

```bash
git clone https://github.com/jhongmed/viberbot.git
cd viberbot
```

### Install Dependencies

```bash
composer install
```

### Configure Git (First Time Only)

```bash
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"
```

---

## 2. Creating a Feature Branch

Always create a new branch for each feature or bug fix.

### Branch Naming Convention

```
feature/feature-name          # New features
bugfix/bug-description        # Bug fixes
hotfix/critical-issue         # Critical production fixes
docs/documentation-update     # Documentation updates
refactor/refactoring-work     # Code refactoring
```

### Create and Switch to Branch

```bash
# Update main branch first
git checkout main
git pull origin main

# Create and switch to a new branch
git checkout -b feature/your-feature-name
```

---

## 3. Development Workflow

### Make Your Changes

```bash
# Edit files in your editor
# For PHP code, follow PSR-12 coding standards
```

### Check Your Changes

```bash
# View modified files
git status

# View the differences
git diff

# View differences for a specific file
git diff path/to/file.php
```

### Run Tests (if available)

```bash
# Run PHPUnit tests
./vendor/bin/phpunit

# Run PHP CodeSniffer for code quality
./vendor/bin/phpcs src/

# Fix code style issues automatically
./vendor/bin/phpcbf src/
```

---

## 4. Staging and Committing

### Stage Changes

```bash
# Stage specific file
git add path/to/file.php

# Stage all changes
git add .

# Stage only part of a file (interactive)
git add -p
```

### View Staged Changes

```bash
git diff --staged
```

### Commit Changes

```bash
# Commit with a descriptive message
git commit -m "Add new feature: description of what you did"

# Commit with detailed message (opens editor)
git commit

# Amend last commit (before pushing)
git commit --amend
```

### Commit Message Best Practices

```
Format: <type>(<scope>): <subject>

Examples:
feat(authentication): add JWT token support
fix(api): resolve null pointer exception in response handler
docs(readme): update installation instructions
refactor(database): optimize query performance
test(unit): add tests for user validation

Rules:
- Use imperative mood ("add" not "added")
- Don't capitalize first letter of subject
- Limit subject line to 50 characters
- Wrap body at 72 characters
- Separate subject from body with blank line
```

---

## 5. Pushing Changes

### Push to Remote

```bash
# Push branch to GitHub (first time)
git push -u origin feature/your-feature-name

# Push subsequent changes
git push
```

### Verify Push

```bash
# Check which branches exist remotely
git branch -r
```

---

## 6. Creating a Pull Request

### On GitHub

1. Go to https://github.com/jhongmed/viberbot
2. You'll see a prompt to create a Pull Request for your branch
3. Click "Compare & pull request"
4. Fill in the PR template with:
   - **Title**: Clear, descriptive title
   - **Description**: What changes were made and why
   - **Related Issues**: Link to any related issues (e.g., `Fixes #123`)
   - **Testing**: Describe how you tested the changes

### PR Description Template

```markdown
## Description
Brief explanation of the changes.

## Type of Change
- [ ] Bug fix (non-breaking change fixing an issue)
- [ ] New feature (non-breaking change adding functionality)
- [ ] Breaking change (fix or feature causing existing functionality to change)
- [ ] Documentation update

## Related Issues
Closes #(issue number)

## Testing
- [ ] Added unit tests
- [ ] Added integration tests
- [ ] Manual testing completed

## Checklist
- [ ] Code follows style guidelines (PSR-12)
- [ ] Self-review completed
- [ ] Comments added for complex logic
- [ ] Documentation updated
- [ ] No new warnings generated
```

---

## 7. Code Review Process

### Responding to Feedback

```bash
# Make requested changes
# (Edit files as needed)

# Stage and commit changes
git add .
git commit -m "Address review feedback"

# Push updates
git push
```

### Updating Branch with Main

If main branch has new commits:

```bash
# Fetch latest changes
git fetch origin

# Rebase on main (cleaner history)
git rebase origin/main

# Or merge main into your branch
git merge origin/main

# Push the updated branch
git push --force-with-lease
```

---

## 8. Merging and Cleanup

### After PR is Approved

1. Click "Squash and merge" or "Merge pull request" on GitHub
2. Delete the branch from GitHub (button appears after merge)

### Local Cleanup

```bash
# Switch back to main
git checkout main

# Pull latest changes
git pull origin main

# Delete local branch
git branch -d feature/your-feature-name

# Delete remote tracking branch
git branch -dr origin/feature/your-feature-name
```

---

## 9. Common Commands Reference

```bash
# Check current branch and status
git status
git branch

# View commit history
git log                           # Full history
git log --oneline               # Condensed history
git log --graph --all           # Visual branch graph
git log -n 5                    # Last 5 commits

# Undo changes
git restore file.php            # Discard changes (before staging)
git reset HEAD file.php         # Unstage file
git revert <commit-hash>        # Undo a commit (safe for pushed changes)

# Stash work temporarily
git stash                       # Save work without committing
git stash list                  # View stashed changes
git stash pop                   # Restore stashed changes

# Fetch without merging
git fetch origin                # Get latest without changing your files

# Switch branches
git checkout main               # Switch to main
git checkout -b new-branch      # Create and switch to new branch
```

---

## 10. PHP-Specific Considerations

### Code Standards

- Follow **PSR-12** coding style
- Use PHP 8.0+ features when appropriate
- Add type hints for function parameters and returns
- Document public methods with PHPDoc comments

### Example PHP Best Practice

```php
/**
 * Send a message via Viber.
 *
 * @param string $userId  The recipient's user ID
 * @param string $message The message content
 *
 * @return bool True if successful, false otherwise
 */
public function sendMessage(string $userId, string $message): bool
{
    // Implementation
}
```

### Before Committing

```bash
# Run linter
./vendor/bin/phpcs

# Run tests
./vendor/bin/phpunit

# Check for security issues
./vendor/bin/security-checker security:check
```

---

## 11. Handling Conflicts

### Resolving Merge Conflicts

```bash
# If conflict occurs during rebase/merge
# 1. Check conflicted files
git status

# 2. Edit files to resolve conflicts (look for <<<< ==== >>>>)

# 3. Stage resolved files
git add resolved-file.php

# 4. Continue rebase
git rebase --continue

# Or abort if needed
git rebase --abort
```

---

## 12. Tips and Best Practices

✅ **Do:**
- Pull before starting work: `git pull origin main`
- Create small, focused commits
- Write clear commit messages
- Test your code before pushing
- Keep branches up to date with main
- Review your own changes before creating a PR
- Use meaningful branch names

❌ **Don't:**
- Commit directly to main
- Force push to shared branches
- Commit sensitive data (passwords, keys)
- Ignore linting or test failures
- Create huge commits mixing multiple features
- Forget to pull before pushing

---

## 13. Quick Start Checklist

```bash
# 1. Clone repo
git clone https://github.com/jhongmed/viberbot.git && cd viberbot

# 2. Install dependencies
composer install

# 3. Create feature branch
git checkout -b feature/my-feature

# 4. Make changes and test
# ... edit files ...
./vendor/bin/phpcs
./vendor/bin/phpunit

# 5. Commit and push
git add .
git commit -m "feat(module): add new feature"
git push -u origin feature/my-feature

# 6. Create PR on GitHub
# (Open GitHub and create pull request)

# 7. After approval, cleanup
git checkout main
git pull origin main
git branch -d feature/my-feature
```

---

## Resources

- [Git Documentation](https://git-scm.com/doc)
- [GitHub Guides](https://guides.github.com/)
- [PSR-12 PHP Coding Standards](https://www.php-fig.org/psr/psr-12/)
- [Composer Documentation](https://getcomposer.org/doc/)
- [PHP Best Practices](https://www.php.net/manual/en/)

---

**Last Updated:** 2026-09-05
