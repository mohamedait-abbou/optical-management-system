# SSH Key Setup for GitHub Actions Deployment

## Step 1: Generate an SSH key pair on your local machine

```bash
ssh-keygen -t ed25519 -C "github-actions-deploy" -f ~/.ssh/github-actions-deploy
```

**Why ed25519?** It's more secure and faster than RSA.
**Why no passphrase?** GitHub Actions cannot type a passphrase — it must connect automatically.

This creates two files:
- `~/.ssh/github-actions-deploy` — the **private key** (keep this secret!)
- `~/.ssh/github-actions-deploy.pub` — the **public key** (goes on the server)

## Step 2: Add the public key to your Ubuntu server

```bash
ssh-copy-id -i ~/.ssh/github-actions-deploy.pub your-user@your-server-ip
```

This adds the public key to `~/.ssh/authorized_keys` on the server.

If `ssh-copy-id` is not available, do it manually:

```bash
cat ~/.ssh/github-actions-deploy.pub
# Copy the output

ssh your-user@your-server-ip
mkdir -p ~/.ssh
echo "paste-the-public-key-here" >> ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
chmod 700 ~/.ssh
```

**Why?** `authorized_keys` is the file SSH reads to allow key-based login.

## Step 3: Test SSH connection

```bash
ssh -i ~/.ssh/github-actions-deploy your-user@your-server-ip
```

You should connect without being asked for a password.

## Step 4: Add the private key to GitHub Secrets

1. Go to your GitHub repository: `https://github.com/mohamedait-abbou/optical-management-system`
2. Click **Settings** → **Secrets and variables** → **Actions**
3. Click **New repository secret**

Add these secrets:

| Secret Name | Value | Why? |
|---|---|---|
| `DEPLOY_HOST` | Your server IP (e.g., `203.0.113.10`) | GitHub Actions uses this to know where to connect |
| `DEPLOY_USER` | Your SSH username (e.g., `ubuntu`, `deploy`) | The user to log in as |
| `DEPLOY_SSH_KEY` | The **entire content** of `~/.ssh/github-actions-deploy` (private key) | Authenticates the connection |
| `DEPLOY_PORT` | `22` (or your custom SSH port) | Optional, defaults to 22 |

To copy the private key content:

```bash
cat ~/.ssh/github-actions-deploy
# Copy everything including ----BEGIN OPENSSH PRIVATE KEY----
```

## Step 5: Test the full pipeline

Push a change to the `main` branch:

```bash
git add .
git commit -m "Test CD pipeline"
git push
```

Then go to your GitHub repo → **Actions** tab → watch the workflow run.

## Security Best Practices

1. **Never commit the private key** to Git (add to `.gitignore` if needed)
2. **Use a dedicated deployment user**, not root
3. **Restrict SSH access** to only what the deploy user needs
4. **Rotate keys** periodically (generate new ones every 6-12 months)
5. **Use a firewall** (UFW) to allow only SSH and HTTP/HTTPS
